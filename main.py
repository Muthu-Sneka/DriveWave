from fastapi import FastAPI,Request,Depends
from fastapi.middleware.cors import CORSMiddleware
from router import router
from sqlalchemy.orm import Session
from models import get_db,models
#from apscheduler.schedulers.background import BackgroundScheduler
from fastapi.staticfiles import StaticFiles
from fastapi.templating import Jinja2Templates 
from starlette.middleware.sessions import SessionMiddleware
from datetime import datetime
from fastapi import FastAPI, HTTPException, Request
from fastapi.responses import HTMLResponse
from starlette.exceptions import HTTPException as StarletteHTTPException
from fastapi.responses import JSONResponse,RedirectResponse
app = FastAPI()

app.add_middleware(

    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
app.add_middleware(SessionMiddleware, secret_key="e8Lj5R$Zv@n8!sWm3P#q")
app.mount("/templates", StaticFiles(directory="templates"), name="templates")
app.mount("/admin/templates", StaticFiles(directory="admin/templates"), name="templates")
templates = Jinja2Templates(directory="templates")

# @app.get("/")
# def index(request:Request):
#     return {"hello": "Drive Wave"}

app.include_router(router, prefix='')


