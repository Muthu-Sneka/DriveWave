from fastapi import APIRouter
from resources.loginSignup import router as userloginRouter
from resources.selectlocation import router as selectlocationRouter
from resources.rentalpoints import router as rentalpointRouter
from resources.vehiclelist import router as vehiclelistRouter
from resources.profile import router as profileRouter
from resources.vehicledetails import router as vehicledetailsRouter
from admin.resources.login import router as adminloginRouter
from admin.resources.dashboard import router as dashboardRouter
from admin.resources.bike import router as bikeRouter
from admin.resources.car import router as carRouter
from admin.resources.rent import router as rentRouter
from admin.resources.query import router as queryRouter

router = APIRouter()
router.include_router(userloginRouter, prefix='', tags=['Login'])
router.include_router(selectlocationRouter, prefix='',tags=['Location'])
router.include_router(rentalpointRouter, prefix='',tags=['rental'])
router.include_router(vehiclelistRouter, prefix='',tags=['list'])
router.include_router(profileRouter, prefix='',tags=['profile'])
router.include_router(vehicledetailsRouter, prefix='',tags=['details'])

router.include_router(adminloginRouter, prefix='/admin',tags=['Adminlogin'])
router.include_router(dashboardRouter, prefix='/admin',tags=['Admindashboard'])
router.include_router(bikeRouter, prefix='/admin',tags=['Bike'])
router.include_router(carRouter, prefix='/admin',tags=['Car'])
router.include_router(rentRouter, prefix='/admin',tags=['Rent'])
router.include_router(queryRouter, prefix='/admin',tags=['Query'])