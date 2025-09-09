<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ATK-Go</title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f9f9f9;
    }
    header {
      background: #2c7dc9;
      color: white;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header nav a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
      font-weight: bold;
    }
    .hero {
      background: #ddd;
      height: 250px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }
    .hero button {
      background: #bbb;
      border: none;
      padding: 10px 20px;
      border-radius: 20px;
    }
    section {
      padding: 20px;
    }
    h2 {
      margin-bottom: 10px;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 15px;
    }
    .card {
      background: #e0e0e0;
      height: 180px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    .footer {
      background: #2c7dc9;
      color: white;
      padding: 30px 20px;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 20px;
      font-size: 14px;
    }
    .footer h4 {
      margin-bottom: 10px;
    }
  </style>
  
</head>
<body>

<div class="hero">
  <button>Browse More ></button>
</div>

<section>
  <h2>Books & Paper</h2>
  <div class="grid">
    <div class="card">
      <img src="images/book1.jpg" alt="Produk 1" />
      <p>Produk 1</p>
    </div>
    <div class="card">
      <img src="images/book2.jpg" alt="Produk 2" />
      <p>Produk 2</p>
    </div>
    <div class="card">
      <img src="images/book3.jpg" alt="Produk 3" />
      <p>Produk 3</p>
    </div>
    <div class="card" style="grid-column: span 2;">
      <p>Shop Now ></p>
    </div>
  </div>
</section>

<section>
  <h2>Basic Writing Tools</h2>
  <div class="grid">
    <div class="card" style="grid-column: span 2;">More...</div>
    <div class="card">Produk 1</div>
    <div class="card">Produk 2</div>
    <div class="card">Produk 3</div>
    <div class="card">Produk 4</div>
  </div>
</section>

<div class="footer">
  <div>
    <h4>About Us</h4>
    <p>About Us<br>Meet the Team<br>Our Story<br>Mission & Vision</p>
  </div>
  <div>
    <h4>Our Services</h4>
    <p>Product List<br>Order<br>Return & Exchange</p>
  </div>
  <div>
    <h4>Helpful Links</h4>
    <p>FAQs<br>Support<br>Help Center</p>
  </div>
  <div>
    <h4>Contact Us</h4>
    <p>atkshop@gmail.com<br>+62 xxx xxxx</p>
  </div>
</div>  

</body>
</html>
