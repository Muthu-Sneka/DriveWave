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

@router.get("/vehiclelist")
def rentalpoints(request:Request,location:str,place:str,starttime:str,endtime:str,vtype:str,db:Session=Depends(get_db)):
    login_status=0
    fetch_vehicle=None
    if vtype=="Car":
        fetch_vehicle=db.query(models.Cars).filter(models.Cars.Cityname==location).filter(models.Cars.Location==place).filter(models.Cars.Status=="Active").all()
    else:
        fetch_vehicle=db.query(models.Bikes).filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).filter(models.Bikes.Status=="Active").all()
    try:
       
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1

            return templates.TemplateResponse('search.html', context={'request': request,'location':location,"login_status":login_status,"starttime":starttime,"endtime":endtime,"location":location,"place":place,"type":vtype,"fetch_vehicle":fetch_vehicle}) 
    except:
        print(fetch_vehicle)
        return templates.TemplateResponse('search.html', context={'request': request,'location':location,"login_status":login_status,"starttime":starttime,"endtime":endtime,"location":location,"place":place,"type":vtype,"fetch_vehicle":fetch_vehicle}) 
    
    


@router.get("/filter")
def rentalpoints(fdata:str,typee:str,place:str,starttime:str,endtime:str,location:str,request:Request,db:Session=Depends(get_db)):
    login_status=0
    fetch_vehicle=None
    fdata=list(fdata.split(','))
    print(fdata)
    result=None
    if typee=="Car":
        query = db.query(models.Cars).filter(models.Cars.Status == "Active") \
    .filter(models.Cars.Cityname == location) \
    .filter(models.Cars.Location == place)
        

        if "high-low" in fdata:
            query = query.order_by(models.Cars.CostperHR.desc())
        elif "low-high" in fdata:
            query = query.order_by(models.Cars.CostperHR)

        if "Manual" in fdata:
            query = query.filter(models.Cars.Transmission == "Manual")
        elif "Automatic" in fdata:
            query = query.filter(models.Cars.Transmission == "Automatic")

        if "4/5 seate" in fdata:
            query = query.filter(models.Cars.Seats == "4/5 seate")
        elif "6/7 seater" in fdata:
            query = query.filter(models.Cars.Seats == "6/7 seater")

        if "Petrol" in fdata:
            query = query.filter(models.Cars.Fueltype == "Petrol")
        elif "Electric" in fdata:
            query = query.filter(models.Cars.Fueltype == "Electric")
        elif "Diesel" in fdata:
            query = query.filter(models.Cars.Fueltype == "Diesel")

        if "Hatchback" in fdata:
            query = query.filter(models.Cars.Vehicletype == "Hatchback")

        if "Sedan" in fdata:
            query = query.filter(models.Cars.Vehicletype == "Sedan")

        if "SUV" in fdata:
            query = query.filter(models.Cars.Vehicletype == "SUV")

        if "Luxury" in fdata:
            query = query.filter(models.Cars.Vehicletype == "Luxury")

        result = query.all()


    else:
            
        if "high-low" in fdata and "low-high" in fdata:
            result = db.query(models.Bikes).filter(models.Bikes.Status == "Active").filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).order_by(models.Bikes.CostperHR.desc()).all()    
        elif "low-high" in fdata:
            result = db.query(models.Bikes).filter(models.Bikes.Status == "Active").filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).order_by(models.Bikes.CostperHR).all()
        elif "high-low" in fdata :
            result = db.query(models.Bikes).filter(models.Bikes.Status == "Active").filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).order_by(models.Bikes.CostperHR.desc()).all()
            
            
        if "Petrol" in fdata and "Electric" in fdata:
            pass
        elif "Petrol" in fdata:
            if result is not None:
                temp_result=[i for i in result if i.Fueltype=="Pertol"]
                result=temp_result
            else:
                result=db.query(models.Bikes).filter(models.Bikes.Fueltype=="Petrol").filter(models.Bikes.Status=="Active").filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).all()
                print(result)
            
        elif "Electric" in fdata:
            if result is not None:
                temp_result=[i for i in result if i.Fueltype=="Electric"]
                result=temp_result
            else:
                result=db.query(models.Bikes).filter(models.Bikes.Fueltype=="Electric").filter(models.Bikes.Status=="Active").filter(models.Bikes.Cityname==location).filter(models.Bikes.Location==place).all()
            
    try:
       
        token = request.session["user"]
        payload = jwt.decode(token, BaseConfig.SECRET_KEY, algorithms=[BaseConfig.ALGORITHM] )
        username: str= payload.get("user_name")
        usermail: str= payload.get("user_email")
        
        if username is None or usermail is None:
            return RedirectResponse("/login",status_code=303)
        else:
            login_status=1

            return templates.TemplateResponse('search.html', context={'request': request,'location':location,"login_status":login_status,"starttime":starttime,"endtime":endtime,"location":location,"place":place,"type":typee,"fetch_vehicle":result,"ffdata":fdata}) 
    except:
        print(result)
        return templates.TemplateResponse('search.html', context={'request': request,'location':location,"login_status":login_status,"starttime":starttime,"endtime":endtime,"location":location,"place":place,"type":typee,"fetch_vehicle":result,"ffdata":fdata}) 