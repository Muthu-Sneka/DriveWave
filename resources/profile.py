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


@router.get("/profile")
def profile(request:Request,db:Session=Depends(get_db)):
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            login_status=1
            rented_vehicles=db.query(models.Rentrequest).filter(models.Rentrequest.Emailid==usermail).filter(models.Rentrequest.Status=="Active").all()
            vehicledetails=[]
            for i in rented_vehicles:
                if i.VehicleId[0]=='C':
                    vehicledetails.append(db.query(models.Cars).filter(models.Cars.Carid==i.VehicleId).filter(models.Cars.Status=="Active").first())
                elif i.VehicleId[0]=='B':
                    vehicledetails.append(db.query(models.Bikes).filter(models.Bikes.Bikeid==i.VehicleId).filter(models.Bikes.Status=="Active").first())
            user_datas=db.query(models.User).filter(models.User.Emailid == usermail,models.User.Status=="Active").first()
            return templates.TemplateResponse('userprofile.html', context={'request': request,"login_status":login_status,"user_datas":user_datas,"rented_vehicles":rented_vehicles,"vehicledetails":vehicledetails}) 
    except JWTError:
         raise HTTPException(status_code=401,detail="Unauthorized")
     

@router.post("/updateProfile")
def updateprofile(request:Request,db:Session=Depends(get_db),userid:str=Form(...),uname:str=Form(...),uemail:str=Form(...),uphone:str=Form(...)):
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
           # raise HTTPException(status_code=401,detail="Unauthorized")
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1
            find=db.query(models.User).filter(models.User.id!=userid,models.User.Username==username,models.User.Emailid==usermail,models.User.Status=="Active").first()
            if find is None:
                db.query(models.User).filter(models.User.id==userid).update({"Username":uname,"Emailid":uemail,"Phonenumber":uphone})
                db.commit()
                error= "Done"   
                json_compatible_item_data = jsonable_encoder(error)
                return JSONResponse(content=json_compatible_item_data)
            else:
                error= "This email id already exists"   
                json_compatible_item_data = jsonable_encoder(error)
                return JSONResponse(content=json_compatible_item_data) 
    except:
        return RedirectResponse("/login",status_code=303)


@router.post("/updatePassword")
def updatepassword(request:Request,db:Session=Depends(get_db),userid:str=Form(...),currpassword:str=Form(...),newpassword:str=Form(...)):
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
            find=db.query(models.User).filter(models.User.id==userid,models.User.Password==currpassword,models.User.Status=="Active").first()
            if find is not None:
                db.query(models.User).filter(models.User.id==userid).update({"Password":newpassword})
                db.commit()
                error= "Done"   
                json_compatible_item_data = jsonable_encoder(error)
                return JSONResponse(content=json_compatible_item_data)
            else:
                error= "Current password is incorrect"   
                json_compatible_item_data = jsonable_encoder(error)
                return JSONResponse(content=json_compatible_item_data) 
    except:
        return RedirectResponse("/login",status_code=303)
    


@router.put("/view_bookeddetails/{id}")
def view_bookeddetails(id:str,request:Request,db:Session=Depends(get_db)):
    login_status=0
    try:
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            bookdetails=db.query(models.Rentrequest).filter(models.Rentrequest.BookingId==id).filter(models.Rentrequest.Status=="Active").first()
            if bookdetails.VehicleId[0]=='B':
                bookdetails.vech=db.query(models.Bikes).filter(models.Bikes.Bikeid==bookdetails.VehicleId).filter(models.Bikes.Status=="Active").first()
            elif bookdetails.VehicleId[0]=='C':
                  bookdetails.vech=db.query(models.Cars).filter(models.Cars.Carid==bookdetails.VehicleId).filter(models.Cars.Status=="Active").first()
            json_compatible_item_data = jsonable_encoder(bookdetails)
            return JSONResponse(content=json_compatible_item_data) 
            
    except JWTError:
        return RedirectResponse("/login",status_code=303)



@router.post("/addreview")
def updatepassword(request:Request,db:Session=Depends(get_db),vid:str=Form(...),rating:str=Form(...),review:str=Form(...)):
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
            c=db.query(models.Feedback).all()
            feedid="FDB"+(str(len(c)+1))
            data=models.Feedback(Feedbackid=feedid,Username=username,Vehicleid=vid,Noofstarts=rating,Review_Content=review,Status="Active",Created_at=current_datetime)
            db.add(data)
            db.commit() 
            error="Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data) 
    except:
       return RedirectResponse("/login",status_code=303)
