function output(text){
    document.getElementById("output").innerHTML += text;
}

function Cart(){

    this.itemGroups = [];

    this.addItemGroup = function(itemGroup){
        this.itemGroups.push(itemGroup);
    }

    this.getTotalAmount = function(){
        let totalAmount = 0.00;
        for (let i = 0; i < this.itemGroups.length; i++) {
            totalAmount += this.itemGroups[i].totalPrice();
        }
        return totalAmount;
    }

    this.getTotalQuantity = function(){
        let totalQuantity = 0;
        for (let i = 0; i < this.itemGroups.length; i++) {
            totalQuantity += this.itemGroups[i].quantity;
        }
        return totalQuantity;
    }

    this.showTotalAmount = function(){
        if (this.itemGroups.length == 0){

            output("<p> You have 0 item, for a total amount of 0.00$, in your cart! </p>");

        } else {

           output("<p> You have " + this.getTotalQuantity() + " item(s), for a total amount of " + this.getTotalAmount().toFixed(2) + "$. The total amount with 15% tax is: " + (this.getTotalAmount() * 1.15).toFixed(2) + "$! </p>");
        }
    }
}

function ItemGroup(name, priceItem, quantity){
    
    this.name = name;
    this.priceItem = priceItem;
    this.quantity = quantity;
    this.totalPrice = function(){
        return this.priceItem * this.quantity;
    }
}

output("<h2> 1) Creating the cart </h2>")
let my_cart = new Cart()
my_cart.showTotalAmount();

output("<h2> 2) Adding 15 pants at 10.05$ each to the cart! </h2>")
let pants = new ItemGroup("pants", 10.05, 15);
my_cart.addItemGroup(pants)
my_cart.showTotalAmount();

output("<h2> 3) Adding 1 coat at 99.99$ to the cart! </h2>")
let coat = new ItemGroup("coat", 99.99, 1);
my_cart.addItemGroup(coat)
my_cart.showTotalAmount();