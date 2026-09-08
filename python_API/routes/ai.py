from flask import Blueprint, request, jsonify
from services.recommendation import recommend

ai_api = Blueprint("ai", __name__)


@ai_api.route("/python/ai", methods=["GET", "POST"])
def ai_recommend():
    if request.method == "POST":
        data = request.get_json(silent=True) or request.form.to_dict()
    else:
        data = request.args.to_dict()

    recommendations = recommend(data if data else {})

    return jsonify({
        "status": True,
        "category": (data.get("category") if data else "all"),
        "recommendations": recommendations
    })