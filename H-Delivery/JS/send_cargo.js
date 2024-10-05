// cargo.js dosyası
function calculateCargoPrice() {
    var cargoType = document.getElementById('cargoType').value;
    var weight = parseFloat(document.getElementById('cargoWeight').value);
    var length = parseFloat(document.getElementById('cargoLength').value);
    var width = parseFloat(document.getElementById('cargoWidth').value);
  
    var basePrice = 10; // Temel ücret
  
    switch (cargoType) {
      case 'standart':
        basePrice += 0;
        break;
      case 'kirilabilir':
        basePrice += 50;
        break;
      case 'degerli':
        basePrice += 75;
        break;
      case 'gida':
        basePrice += 25;
        break;
      default:
        basePrice += 0;
        break;
    }
  
    if (width>20 && width<= 50) {
      basePrice += 20;
    }
    else if (width > 50){
      basePrice+=40;
    }
    else{
      basePrice+=2;
    }

  
    var paymentType = document.querySelector('input[name="paymentType"]:checked');
  
    var cargoPrice = basePrice + (weight * 1.5) + (length * 0.5) + (width * 0.5);
  
    document.getElementById('cargoPrice').value = cargoPrice.toFixed(2);
  }
  
  document.addEventListener('DOMContentLoaded', function() {

    calculateCargoPrice();

    // Event listener'ları burada ekleyin
    document.getElementById('cargoType').addEventListener('change', calculateCargoPrice);
    document.getElementById('cargoWeight').addEventListener('input', calculateCargoPrice);
    document.getElementById('cargoLength').addEventListener('input', calculateCargoPrice);
    document.getElementById('cargoWidth').addEventListener('input', calculateCargoPrice);
    document.querySelectorAll('input[name="paymentType"]').forEach(item => {
        item.addEventListener('change', calculateCargoPrice);
    });
});

  