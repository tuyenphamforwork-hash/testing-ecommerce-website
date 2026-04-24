<?php 
    include_once('./includes/headerNav.php');
    include_once('./includes/restriction.php');
 ?>
 <head>
     <style>
        .content-box-post {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
         .addpost{
            border: 1px solid black;
            width: 80%;
            padding: 25px;
            border-radius: 16px;
            background-color: #f1f1f1;
         }

     </style>
 </head>
<div class="content-box-post">
    
 <div class="addpost">
 <h1>Add post here</h1>

  <!-- Form -->
    <form
      action="save-post.php"
      method="POST"
      enctype="multipart/form-data"
      class="row g-3"
    >
      <div class="col-12">
        <label for="inputAddress" class="form-label">Title</label>
        <input
          name="prod-title"
          type="text"
          class="form-control"
          placeholder="Product Name..."
          required="required"
        />
      </div>
      <div class="col-md-6">
        <label for="inputEmail4" class="form-label">Price</label>
        <input
          name="prod-price"
          type="number"
          class="form-control"
          value=""
          required="required"
        />
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Discount</label>
        <input
          name="prod-discount"
          type="number"
          class="form-control"
          required="required"
        />
      </div>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"
          >Description</label
        >
        <textarea
          class="form-control"
          rows="3"
          name="prod-desc"
          required="required"
        ></textarea>
      </div>
      <div class="col-md-6">
        <label for="inputCity" class="form-label">No. of Items</label>
        <input
          type="number"
          class="form-control"
          name="noofitem"
          value=""
          required="required"
        />
      </div>
      <div class="col-md-6">
        <label for="inputState" class="form-label">Category</label>
        <select name="prod-category" value="" class="form-select">
          <optgroup label="Clothes">
            <option value="Shirt">Shirt</option>
            <option value="shorts & jeans">Shorts & Jeans</option>
            <option value="jacket">Jacket</option>
            <option value="dress & frock">Dress & Frock</option>
          </optgroup>
          <optgroup label="Footwear">
            <option value="Sports">Sports</option>
            <option value="Formal">Formal</option>
            <option value="Casual">Casual</option>
            <option value="Safety Shoes">Safety Shoes</option>
          </optgroup>
          <optgroup label="Jewelry">
            <option value="Earrings">Earrings</option>
            <option value="Couple Rings">Couple Rings</option>
            <option value="Necklace">Necklace</option>
          </optgroup>
          <optgroup label="Perfume">
            <option value="Clothes Perfume">Clothes Perfume</option>
            <option value="Deodorant">Deodorant</option>
            <option value="jacket">Jacket</option>
            <option value="dress & frock">Dress & Frock</option>
          </optgroup>
          <optgroup label="Cosmetics">
            <option value="Shampoo">Shampoo</option>
            <option value="Sunscreen">Sunscreen</option>
            <option value="Body Wash">Body Wash</option>
            <option value="Makeup Kit">Makeup Kit</option>
          </optgroup>
          <optgroup label="Glasses">
            <option value="Sunglasses">Sunglasses</option>
            <option value="Lenses">Lenses</option>
          </optgroup>
          <optgroup label="Bags">
            <option value="Shopping Bag">Shopping Bag</option>
            <option value="Purse">Purse</option>
            <option value="Wallet">Wallet</option>
          </optgroup>
          <option value="electronics">Electronics</option>
        </select>
      </div>
      <div class="col-12">
        <label for="inputAddress" class="form-label">Image</label>
        <input
          type="file"
          name="prod-img"
          class="form-control"
          required="required"
        />
      </div>
      <div class="form-check">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="flexRadioDefault2"
        />
        <label class="form-check-label" for="flexRadioDefault2">
          Available
        </label>
      </div>
      <div class="col-12">
        <button type="submit" name="submit" class="btn btn-primary">Add</button>
      </div>
    </form>
                  <!--/Form -->
 </div>
</div>




