from fastapi import APIRouter, Depends, HTTPException, FastAPI, Request, Form
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

@router.get("/login")
def login_page(request:Request):   
    return templates.TemplateResponse('login.php', context={'request': request})

@router.post('/logincheck')
def logincheck(request:Request,db:Session=Depends(get_db),user_name:str=Form(...),password:str=Form(...)):
    find=db.query(models.Admin).filter(models.Admin.Username==user_name,models.Admin.Password==password,models.Admin.Status=='Active').first()
    if find is None:
        error="Invalid creditional"
        return templates.TemplateResponse('login.php',context={'request':request,'error':error})
    else:
        access_token_expires=timedelta(minutes=BaseConfig.ACCESS_TOKEN_EXPIRE_MINUTES)
        access_token=create_access_token(data={"user_name":find.Username},expires_delta=access_token_expires)
        request.session["admin"]=access_token
        return RedirectResponse('/admin/dashboard',status_code=303)