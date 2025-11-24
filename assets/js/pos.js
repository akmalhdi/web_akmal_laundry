// // variable : let(paling umum digunakan), var, const
// // php var : $, define, const

// let nama = "Sunandar Sujito";
// var name = "Sumi Sukamti";
// const fullname = "Joko Suminten"; //nilainya tetap, tidak boleh merubah nilai

// // untuk output/print
// // document.write();
// // console.log({
// //     "nama": nama,
// //     "fullname": fullname
// // }); //paling umum menggunakan ini
// // alert();

// // operator
// let angka1 = 10;
// let angka2 = 20;
// console.log(angka1 + angka2);
// console.log(angka1 - angka2);
// console.log(angka1 / angka2);
// console.log(angka1 * angka2);
// console.log(angka1 % angka2);
// console.log(angka1 ** angka2);

// // operator penugasan
// let x = 10;
// x += 5;
// console.log(x);

// // operator pembandingan
// let a = 2;
// let b = 1;
// if (a === b) {
//   console.log("ya");
// } else {
//   console.log("tidak");
// }
// console.log(a > b);
// console.log(a < b);

// // let umur = 20;
// // let p = true;
// // if (umur >= 17 && p) {
// //   console.log("Boleh driving");
// // } else {
// //   console.log("tidak driving");
// // }

// // array
// let buah = ["pisang", "salak", "semangka"];
// console.log("buah dikeranjang:", buah);
// console.log("saya mau buah:", buah[0]);
// buah[1] = "Nanas";
// console.log("buah baru dikeranjang:", buah);
// buah.push("pepaya"); //untuk menambah nilai baru
// console.log("Buah", buah);
// buah.pop(); //untuk menghapus nilai array terakhir
// console.log("buah", buah);

// //
// document.getElementById('product-title').innerHTML = "Data Product";
// // document.querySelector('#product-title');

// // document.querySelector('.category-btn');
// // let btn = document.getElementsByClassName('category-btn');
// // // btn[0].style.color = 'red';
// // console.log("ini button", btn);

// let buttons = document.querySelectorAll('.category-btn');
// // buttons.forEach(function (btn) {});
// buttons.forEach((btn) => {
//     btn.style.color = 'red';
//     console.log(btn);
// });

// let card = document.querySelector('#card');
// let h3 = document.createElement('h3');
// let textH3 = document.createTextNode('Nama Product (dengan createTextNode)');
// h3.textContent = 'Nama Product (dengan textContent)';

// let p = document.createElement("p");
// p.innerText = "apasi ini";
// p.textContent = "ini apasi";

// card.appendChild(textH3)
// card.appendChild(h3);
// card.appendChild(p);

let currentCategory = "all";
function filterCategory(category, event) {
  currentCategory = category;

  let buttons = document.querySelectorAll(".category-btn");
  buttons.forEach((btn) => {
    btn.classList.remove("active");
    btn.classList.remove("btn-primary");
    btn.classList.add("btn-outline-primary");
  });
  event.classList.add("active");
  event.classList.remove("btn-outline-primary");
  event.classList.add("btn-primary");
  console.log({
    currentCategory: currentCategory,
    category: category,
    event: event,
  });
  renderProducts();
}

function renderProducts(searchProduct = "") {
  const productGrid = document.getElementById("productGrid");
  productGrid.innerHTML = "";

  // filter
  const filtered = products.filter((p) => {
    // shorthand
    const matchCategory =
      currentCategory === "all" || p.category_name === currentCategory;
    const matchSearch = p.product_name.toLowerCase().includes(searchProduct);
    return matchCategory && matchSearch;
  });

  // munculin data dari table product
  filtered.forEach((product) => {
    const col = document.createElement("div");
    col.className = "col-md-4 col-sm-6";
    col.innerHTML = `<div class="card product-card" 
        onclick="addToCart(${product.id})">

            <div class="product-img">
                <img src="../${product.product_photo}" width="100%">
            </div>

            <div class="card-body">
                <span class="badge bg-secondary badge-category">${
                  product.category_name
                }</span>
                <h6 class="card-title mt-2 mb-2">${product.product_name}</h6>
                <p class="card-text text-primary fw-bold">
                ${Number(product.product_price).toLocaleString("id-ID", {
                  style: "currency",
                  currency: "IDR",
                  minimumFractionDigits: 0,
                })}
                </p>
            </div>
            
        </div>`;

    productGrid.appendChild(col);
  });
}

let cart = [];
function addToCart(id) {
  const product = products.find((p) => p.id == id);

  const existing = cart.find((item) => item.id == id);

  if (existing) {
    existing.quantity += 1;
  } else {
    cart.push({ ...product, quantity: 1 });
  }
  renderCart();
}

function renderCart() {
  const cartContainer = document.querySelector("#cartItems");
  cartContainer.innerHTML = "";

  if (cart.length === 0) {
    cartContainer.innerHTML = `
                <div class="cart-items" id="cartItems">
                    <div class="text-center text-muted mt-5">
                        <i class="bi bi-cart mb-3"></i>
                        <p>Cart Empty</p>
                    </div>
                </div>`;
    updateTotal();
  }
  cart.forEach((item, index) => {
    const div = document.createElement("div");
    div.className =
      "cart-item d-flex justify-content-between align-items-center mb-2";
    div.innerHTML = `
              <div>
                    <strong>${item.product_name}</strong><br>
                    <small>
                    ${Number(item.product_price).toLocaleString("id-ID", {
                      style: "currency",
                      currency: "IDR",
                      minimumFractionDigits: 0,
                    })}
                    </small>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-outline-secondary me-2" onclick="changeQty(${
                      item.id
                    }, -1)">-</button>
                    <span>${item.quantity}</span>
                    <button class="btn btn-outline-secondary ms-2" onclick="changeQty(${
                      item.id
                    }, 1)">+</button>
                    <button class="btn btn-danger btn-sm ms-3" onclick="removeItem(${
                      item.id
                    })">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>`;
    cartContainer.appendChild(div);
  });
  updateTotal();
}

function removeItem(id) {
  cart = cart.filter((p) => p.id != id);
  renderCart();
}

function changeQty(id, x) {
  const item = cart.find((p) => p.id == id);
  if (!item) {
    return;
  }
  item.quantity += x;
  if (item.quantity <= 0) {
    alert("Minimum harus 1 product");
    item.quantity += 1;
    // cart = filter((p) => p.id != id);
  }
  renderCart();
}

function updateTotal() {
  const subtotal = cart.reduce(
    (sum, item) => sum + item.product_price * item.quantity,
    0
  );
  const tax = subtotal * 0.1;
  const total = subtotal + tax;

  document.getElementById("subtotal").textContent = `${Number(
    subtotal
  ).toLocaleString("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  })}`;

  document.getElementById("tax").textContent = `${Number(tax).toLocaleString(
    "id-ID",
    {
      style: "currency",
      currency: "IDR",
      minimumFractionDigits: 0,
    }
  )}`;

  document.getElementById("total").textContent = `${Number(
    total
  ).toLocaleString("id-ID", {
    style: "currency",
    currency: "IDR",
    minimumFractionDigits: 0,
  })}`;

  document.getElementById("subtotal_value").value = subtotal;

  document.getElementById("tax_value").value = tax;

  document.getElementById("total_value").value = total;
}

// fungsi clear product pada button clear cart
document.getElementById("clearCart").addEventListener("click", function () {
  cart = [];
  renderCart();
});

async function processPayment() {
  if (cart.length === 0) {
    alert("Cart Empty");
    return;
  }

  const order_code = document.querySelector(".orderNumber").textContent.trim();
  const subtotal = document.querySelector("#subtotal_value").value.trim();
  const tax = document.querySelector("#tax_value").value.trim();
  const grandTotal = document.querySelector("#total_value").value.trim();

  try {
    const res = await fetch("add-pos.php?payment", {
      method: "POST",
      headers: { "Content-Type": "aplication/json" },
      body: JSON.stringify({ cart, order_code, subtotal, tax, grandTotal }),
    });

    const data = await res.json();

    if (data.status == "success") {
      alert("transaction success");
      window.location.href = "print.php";
    } else {
      alert("transaction failed", data.message);
    }
  } catch (error) {
    alert("transaction failed");
    console.log("error", error);
  }
}

// DomContentLoaded : akan meload function pertama kali
renderProducts();

document
  .getElementById("searchProduct")
  .addEventListener("input", function (e) {
    const searchProduct = e.target.value.toLowerCase();
    renderProducts(searchProduct);
  });
