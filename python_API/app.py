from flask import Flask
from flask_cors import CORS

from routes.ai import ai_api
from routes.products import products_api

app = Flask(__name__)

CORS(app)

app.register_blueprint(products_api)
app.register_blueprint(ai_api)


@app.route("/")
def home():
    return {
        "status": True,
        "message": "Python API Running"
    }


if __name__ == "__main__":
    app.run(
        host="127.0.0.1",
        port=5000,
        debug=True
    )
