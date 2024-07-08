from fastapi import APIRouter, Depends, HTTPException, FastAPI, Request, Form
from fastapi.encoders import jsonable_encoder
from fastapi.templating import Jinja2Templates
from fastapi.responses import JSONResponse, RedirectResponse
from jose import JWTError
from sqlalchemy.orm import Session
from config.base_config import BaseConfig
from fastapi.staticfiles import StaticFiles
from datetime import  datetime,date, timedelta
from models import get_db,models
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from resources.utils import create_access_token
from starlette.middleware.sessions import SessionMiddleware
import requests
from jose import jwt, JWTError
current_datetime = datetime.utcnow()
router = APIRouter()
templates = Jinja2Templates(directory="templates")
router.mount("/templates", StaticFiles(directory="templates"), name="templates")



@router.get("/vehicledetails")
def rentalpoints(id:str,starttime:str,endtime:str,typee:str,location:str,place:str,request:Request,db:Session=Depends(get_db)):
    vehicle_details=None
    date_format = "%Y-%m-%dT%H:%M"
    date1 = datetime.strptime(starttime, date_format)
    date2 = datetime.strptime(endtime, date_format)

    time_difference = date2-date1
    starttime = date1.strftime("%a, %d %b, %I:%M %p")
    endtime = date2.strftime("%a, %d %b, %I:%M %p")
    total_hours = round(time_difference.total_seconds() / 3600)
    if id[0]=='B':
        vehicle_details=db.query(models.Bikes).filter(models.Bikes.Bikeid==id).filter(models.Bikes.Status=="Active").first()
    elif id[0]=='C':
        vehicle_details=db.query(models.Cars).filter(models.Cars.Carid==id).filter(models.Cars.Status=="Active").first()
    total_cost=vehicle_details.CostperHR*total_hours
    final_amount=total_cost+500+120
    review=db.query(models.Feedback).filter(models.Feedback.Vehicleid==id).filter(models.Feedback.Status=="Active").all()
    userdetails=[]
    for i in review:
        userdetails.append([i,db.query(models.User).filter(models.User.Username==i.Username).filter(models.User.Status=="Active").first()])
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1
            return templates.TemplateResponse('vehicledetails.html', context={'request': request,"login_status":login_status,"vehicle_details":vehicle_details,"type":typee,"starttime":starttime,"endtime":endtime,"total_cost":total_cost,"final_amount":final_amount,"location":location,"place":place,"id":id,"review":review,"userdetails":userdetails}) 
    except:
         return templates.TemplateResponse('vehicledetails.html', context={'request': request,"login_status":login_status,"vehicle_details":vehicle_details,"type":typee,"starttime":starttime,"endtime":endtime,"total_cost":total_cost,"final_amount":final_amount,"location":location,"place":place,"id":id,"review":review,"userdetails":userdetails}) 
     
     

@router.get("/payment")
def rentalpoints(request:Request,db:Session=Depends(get_db)):
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1
            return templates.TemplateResponse('payment.html', context={'request': request,"login_status":login_status}) 
    except:
         return templates.TemplateResponse('payment.html', context={'request': request,"login_status":login_status}) 


@router.post("/payment")
def payment(request:Request,db:Session=Depends(get_db),vehicleid:str=Form(...),starttime:str=Form(...),endtime:str=Form(...),final_cost:str=Form(...),paymentid:str=Form(...),city:str=Form(...),location:str=Form(...)):
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1
            total_booking=db.query(models.Rentrequest).all()
            bookingid='BOK'+str(len(total_booking)+1)
            data=models.Rentrequest(BookingId=bookingid,Username=username,Emailid=usermail,VehicleId=vehicleid,Pickuptime=starttime,Droptime=endtime,Totalcost=final_cost,PaymentId=paymentid,City=city,Location=location,TimeofpaymentCompletion=current_datetime,Status="Active",Created_at=current_datetime)
            db.add(data)
            db.commit()
            if vehicleid[0]=='B':
                k=db.query(models.Bikes).filter(models.Bikes.Bikeid==vehicleid,models.Bikes.Status=="Active").first()
                db.query(models.Bikes).filter(models.Bikes.Bikeid==vehicleid).update({"Nooftrips":(k.Nooftrips)+1})
                db.commit()
            else:
                k=db.query(models.Cars).filter(models.Cars.Carid==vehicleid,models.Cars.Status=="Active").first()
                db.query(models.Cars).filter(models.Cars.Carid==vehicleid).update({"Nooftrips":(k.Nooftrips)+1})
                db.commit()
                
            error = "Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        error = "usernotfound"
        json_compatible_item_data = jsonable_encoder(error)
        return JSONResponse(content=json_compatible_item_data)