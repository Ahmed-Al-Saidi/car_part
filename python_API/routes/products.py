from flask import Blueprint,jsonify

products_api = Blueprint(
    "products",
    __name__
)



@products_api.route(
    "/python/products",
    methods=["GET"]
)
def products():


    data=[
        {
            "name":"coffee",
            "price":5
        },
        {
            "name":"tea",
            "price":3
        }
    ]


    return jsonify(data)