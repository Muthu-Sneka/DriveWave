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


@router.get("/query")
def bike(request:Request,db:Session=Depends(get_db)):   
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else: 
            Query=db.query(models.Query).filter(models.Query.Status=="Active").all()
            return templates.TemplateResponse('query.php', context={'request': request,'query':Query})
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)
       # raise HTTPException(status_code=401,detail="Unauthorized")


@router.put("/view_query/{id}")
def viewQuery(id:int,request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:
            query=db.query(models.Query).filter(models.Query.id==id,models.Query.Status=="Active").first()
            json_compatible_item_data = jsonable_encoder(query)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
            raise HTTPException(status_code=401,detail="Unauthorized")
        #raise HTTPException(status_code=401,detail="Unauthorized")
        

@router.put("/delete_query/{id}")
def delete_query(id:int,request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None:
            raise HTTPException(status_code=401,detail="Unauthorized")
        else:    
            db.query(models.Query).filter(models.Query.id==id).update({"Status":"Inactive"})
            db.commit()
            error = "Done"
            json_compatible_item_data = jsonable_encoder(error)
            return JSONResponse(content=json_compatible_item_data)
    except JWTError:
        return RedirectResponse("/admin/login", status_code=303)