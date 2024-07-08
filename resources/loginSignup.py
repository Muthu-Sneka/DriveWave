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
from resources.utils import create_access_token
from starlette.middleware.sessions import SessionMiddleware
#from jose import jwt, JWTError
current_datetime = datetime.utcnow()
router = APIRouter()
templates = Jinja2Templates(directory="templates")
router.mount("/templates", StaticFiles(directory="templates"), name="templates")

@router.get("/login")
def login_page(request:Request):   
    return templates.TemplateResponse('login.html', context={'request': request})


@router.post("/signup")
def logcheck(request:Request,db:Session=Depends(get_db),susername:str=Form(...),semail:str=Form(...),smobile:str=Form(...),spassword:str=Form(...)):
    find=db.query(models.User).filter(models.User.Emailid==semail,models.User.Status=="Active").first()
    if find is None:
        new_user=models.User(Username=susername,Emailid=semail,Phonenumber=smobile,Password=spassword,Status="Active",Created_at=current_datetime)
        db.add(new_user)
        db.commit()
        error="Valid Creditional"
        access_token_expires = timedelta(minutes=BaseConfig.ACCESS_TOKEN_EXPIRE_MINUTES)
        access_token = create_access_token(data={"user_name": susername,"user_email": semail},expires_delta=access_token_expires)
        sessid = access_token
        request.session["user"] = sessid
        error= "Done"   
        json_compatible_item_data = jsonable_encoder(error)
        return JSONResponse(content=json_compatible_item_data)
        
    else:
        error= "This EmailID already exists"   
        json_compatible_item_data = jsonable_encoder(error)
        return JSONResponse(content=json_compatible_item_data)
        

@router.post("/login")
def logcheck(request:Request,db:Session=Depends(get_db),lemail:str=Form(...),lpassword:str=Form(...)):
    find=db.query(models.User).filter(models.User.Emailid==lemail,models.User.Password==lpassword,models.User.Status=="Active").first()
    if find is not None:
        error="Valid Creditional"
        access_token_expires = timedelta(minutes=BaseConfig.ACCESS_TOKEN_EXPIRE_MINUTES)
        access_token = create_access_token(data={"user_name": find.Username,"user_email": find.Emailid},expires_delta=access_token_expires)
        sessid = access_token
        request.session["user"] = sessid
        error= "Done"   
        json_compatible_item_data = jsonable_encoder(error)
        return JSONResponse(content=json_compatible_item_data)
        
    else:
        error= "Invalid password or emailid"   
        json_compatible_item_data = jsonable_encoder(error)
        return JSONResponse(content=json_compatible_item_data)

@router.get("/logout")
def logout(request:Request):
    request.session.clear()
    return RedirectResponse("/", status_code=303)