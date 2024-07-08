from config.base_config import BaseConfig

class Configuration(BaseConfig):
    DEBUG = True
    DB_URI = 'mysql+pymysql://root:12345@localhost/drivewave' 