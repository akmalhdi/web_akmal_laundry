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

function selectCustomers() {
  const select = document.getElementById("customer_id");
  const phone = select.options[select.selectedIndex].getAttribute("data-phone");
  const address =
    select.options[select.selectedIndex].getAttribute("data-address");
  document.getElementById("phone").value = phone || "";
  document.getElementById("address").value = address || "";
}

function openModal(service) {
  document.getElementById("modal_id").value = service.id;
  document.getElementById("modal_name").value = service.name;
  document.getElementById("modal_price").value = service.price;
  document.getElementById("modal_qty").value = 1;

  new bootstrap.Modal("#exampleModal").show();
}

let cart = [];

function addToCart() {
  const id = document.getElementById("modal_id").value;
  const name = document.getElementById("modal_name").value;
  const price = parseInt(document.getElementById("modal_price").value);
  const qty = parseInt(document.getElementById("modal_qty").value);

  const existing = cart.find((item) => item.id == id);

  if (existing) {
    existing.quantity += qty;
  } else {
    cart.push({
      id,
      name,
      price,
      qty,
    });
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
                    <strong>${item.name}</strong><br>
                    <small>
                    ${Number(item.price).toLocaleString("id-ID", {
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
                    <span>${item.qty}</span>
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
  item.qty += x;
  if (item.qty <= 0) {
    cart = cart.filter((p) => p.id != id);
  }
  renderCart();
}

function updateTotal() {
  const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
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
  const customer_id = document.getElementById("customer_id").value;
  //   const customer_id =
  //     selectCustomer.options[selectCustomer.selectedIndex].value;

  const order_end_date = document.getElementById("order_end_date").value;

  try {
    const res = await fetch("add-order.php?payment", {
      method: "POST",
      headers: { "Content-Type": "aplication/json" },
      body: JSON.stringify({
        cart,
        order_code,
        subtotal,
        tax,
        grandTotal,
        customer_id,
        order_end_date,
      }),
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
