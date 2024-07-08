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


@router.get('/dashboard')
def getDashboard(request:Request,db:Session=Depends(get_db)):
    try:
        token=request.session["admin"]
        payload=jwt.decode(token,BaseConfig.SECRET_KEY,algorithms=[BaseConfig.ALGORITHM])
        user_name:str=payload.get('user_name')

        if user_name is None :

            raise HTTPException(status_code=401,details="Unauthorized")
        else:
            bikecount=db.query(models.Bikes).filter(models.Bikes.Status=="Active").all()
            carcount=db.query(models.Cars).filter(models.Cars.Status=="ACTIVE").all()
            bikecount=len(bikecount)
            carcount=len(carcount)
            
            return templates.TemplateResponse('dashboard.php', context={'request': request,"bikecount":bikecount,"carcount":carcount})
    
    except:
        return RedirectResponse("/admin/login", status_code=303)

@router.get("/logout")
def logout(request:Request):
    request.session.clear()
    return RedirectResponse("/admin/login", status_code=303)