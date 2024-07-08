import shutil
from typing import List
import uuid
from fastapi import APIRouter, Depends, File, HTTPException, FastAPI, Request, Form, UploadFile
from fastapi.encoders import jsonable_encoder
from fastapi.templating import Jinja2Templates
from fastapi.responses import JSONResponse, RedirectResponse
from sqlalchemy.orm import Session
from config.base_config import BaseConfig
from fastapi.staticfiles import StaticFiles
from datetime import  datetime,date, timedelta
from models import get_db,models
from fastapi.security import OAuth2PasswordBearer, OAuth2PasswordRequestForm
from admin.resources.utils import create_access_token
from starlette.middleware.sessions import SessionMiddleware
from jose import jwt, JWTError
current_datetime = datetime.utcnow()
router = APIRouter()
templates = Jinja2Templates(directory="admin/templates")
router.mount("/admin/templates", StaticFiles(directory="admin/templates"), name="templates")


@router.get("/rentrequest")
def rent(request:Request,db:Session=Depends(get_db)):   
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            
            rent=db.query(models.Rentrequest).filter(models.Rentrequest.Status=="Active").all()
            return templates.TemplateResponse('rentrequest.php', context={'request': request,'rent':rent})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
       # raise HTTPException(status_code=401,detail="Unauthorized")


@router.put("/viewrent/{id}")
def viewrent(id:int,request:Request,db:Session=Depends(get_db)):   
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            vrent=db.query(models.Rentrequest).filter(models.Rentrequest.id==id,models.Rentrequest.Status=="Active").first()
            if vrent.VehicleId[0]=='B':
                vrent.vehicle=db.query(models.Bikes).filter(models.Bikes.Bikeid==vrent.VehicleId,models.Bikes.Status=="Active").first()
            else:
                 vrent.vehicle=db.query(models.Cars).filter(models.Cars.Carid==vrent.VehicleId,models.Cars.Status=="Active").first()
                
        
            json_compatible_item_data = jsonable_encoder(vrent)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)