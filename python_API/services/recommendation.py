def recommend(data):
    if not isinstance(data, dict):
        category = None
    else:
        category = data.get("category")

    if category == "coffee":
        return [
            "latte",
            "espresso",
            "cappuccino"
        ]
    elif category == "food":
        return [
            "cake",
            "sandwich"
        ]
    else:
        return [
            "special offer"
        ]