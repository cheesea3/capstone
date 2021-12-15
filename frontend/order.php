<!-- navbar -->
<header>
  <nav class="shadow items-center  md:pl-48 p-3 bg-green-500 text-white">
    <div x-data="{ open: false }" class="flex-1 md:flex">
      <div class="flex items-center flex-1">
        <a href="./">
          <div class=" md:flex-1 mr-2 text-white select-none font-bold">Food Engine - Order</div>
        </a>
        <button @click="open = ! open" class="md:hidden ml-auto rounded px-4 py-2 focus:outline-none bg-green-400">
          <template x-if="!open">
            <div>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" /> </svg>
            </div>
          </template>
          <template x-if="open">
            <div>X</div>
          </template>
        </button>
      </div>
      <div x-bind:class="! open ? 'hidden' : 'block'" class="md:flex mt-1 md:mt-0 space-y-2 md:space-y-0 flex-row-reverse md:pr-48">
	  <div class="pt-4 md:pt-0">
        <a href="./logout">
          <div class="text-center md:ml-2 md:text-left bg-green-400 transition hover:bg-green-700 hover:text-green-600 select-none cursor-pointer px-4 py-2 rounded text-white"> Log out </div>
        </a>
		</div>
		<div>
        <a href="./home">
          <div class="text-center md:ml-2 md:text-left bg-green-400 transition hover:bg-green-700 hover:text-green-600 select-none cursor-pointer px-4 py-2 rounded text-white"> Home </div>
        </a>
		</div>
      </div>
    </div>
  </nav>
</header>
   <div class="lg:flex">
   <main class="container flex mx-auto w-full items-center justify-center">
   <div class="flex flex-col space-y-4">
   <div class="flex flex-col pt-4 m-4">
<?php
   /*Call our notification handling*/ include("../frontend/sitenotif.php");
   ?>
  </div>
   <ul class="flex flex-col p-2">
   <div class="mb-2">
<div class="text-gray-600">Order type:</div><div id="ordertype"></div> <script>
var ordertype = "<?php echo $_GET['type'];?>".charAt(0).toUpperCase() + "<?php echo $_GET['type'];?>".slice(1).toLowerCase();
document.getElementById("ordertype").innerHTML=ordertype</script>

		<?php if($customizePizza === true):?>
<div>
<div class="flex flex-row flex-row-reverse"><a href="https://postogon.com/school/public_html/order?type=<?php echo $_GET["type"];?>" class="px-4 py-2 bg-green-400 text-white text-semibold rounded hover:bg-green-600 hover:text-green-400 cursor-pointer transition">Back to Menu</a></div>
</div><?php endif;?>

</div>
  <section class="container mx-auto pt-6 -mb-6">
        <div class="sm:flex flex-wrap">
		<?php if($customizePizza === false):?>
        <?php foreach($orders as $item): ?>
          <div class="sm:w-6/12 lg:w-4/12 px-4 mb-6">
            <div class="md:flex md:items-stretch md:shadow-lg md:bg-white md:rounded-lg">
              <div class="md:w-6/12 lg:w-5/12">
                <img class="rounded-lg md:rounded-r-none w-full h-full object-cover object-left" src="<?php echo $item['picture'];?>">
              </div>

              <div class="relative self-center mx-2 md:mx-0 p-2 md:p-4 shadow-lg md:shadow-none bg-white md:bg-transparent rounded-lg md:rounded-l-none -mt-2 md:mt-0 md:w-6/12 lg:w-7/12">
                <h2 class="text-xl tracking-tight font-semibold uppercase text-secondary mb-2">
                <?php echo $item['name'];?>
                </h2>
                <p class="text-gray-700 leading-snug">
                <?php echo $item['description']; ?>
                </p>
                <span class="mt-2 text-sm font-semibold text-gray-800 block">
                $<?php echo $item['price']; ?>
                </span>
                <form method="post">
            <input name="id" type="hidden" value="<?php echo $item['id']; ?>"></input>
            <?php if(order::addedItem($item['id'])):?>
		      <input name="delete" type="hidden"></input>     
            <button class="text-center w-full text-sm bg-red-700 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Remove Item</button>
            <?php else: ?>
            <input name="insert" type="hidden"></input>     
            <button class="text-center w-full text-sm bg-blue-500 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Add Item</button>
            <?php endif; ?>            
            </form>
              </div>
            </div>
          </div>
          <?php endforeach; ?>		
<div class="sm:w-6/12 lg:w-4/12 px-4 mb-6">
            <div class="md:flex md:items-stretch md:shadow-lg md:bg-white md:rounded-lg">
              <div class="md:w-6/12 lg:w-5/12">
                <img class="rounded-lg md:rounded-r-none w-full h-full object-cover object-left" src="https://www.idahopizzacompany.com/Documents%20and%20Settings/15/Site%20Documents/2015/Feature/feature-allyoucaneat.jpg">
              </div>
              <div class="relative self-center mx-2 md:mx-0 p-2 md:p-4 shadow-lg md:shadow-none bg-white md:bg-transparent rounded-lg md:rounded-l-none -mt-2 md:mt-0 md:w-6/12 lg:w-7/12">
                <h2 class="text-xl tracking-tight font-semibold uppercase text-secondary mb-2">
                Pizza                </h2>
                <p class="text-gray-700 leading-snug">
                Create your own pizza</p>
                <span class="mt-2 text-sm font-semibold text-gray-800 block">
                Starts from $7.50</span>
							<?php if(order::customizeActive()):?>
                <form method="post">
            <input name="pizza" type="hidden" value="pizza">
                        <input name="customize" type="hidden">     
            <button class="text-center w-full text-sm bg-blue-500 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Edit Pizza</button>
            </form>
			                        <?php endif; ?>
									
							<?php if(order::customizeActive()):?>
                <form method="post">
            <input name="pizza" type="hidden" value="pizza">
                        <input name="remove" type="hidden">     
            <button class="text-center w-full text-sm bg-red-500 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Remove Pizza</button>
            </form>
			                        <?php endif; ?>
							<?php if(!order::customizeActive()):?>
                <form method="post">
            <input name="pizza" type="hidden" value="pizza">
                        <input name="customize" type="hidden">     
            <button class="text-center w-full text-sm bg-blue-500 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Add Pizza</button>
            </form>
			                        <?php endif; ?>			
									
              </div>
            </div>
          </div>
			<?php endif;?>
			
			
			
			
			
			
			
			
		<?php if($customizePizza === true):?>
        <?php foreach($toppings as $item): ?>
          <div class="sm:w-6/12 lg:w-4/12 px-4 mb-6">
            <div class="md:flex md:items-stretch md:shadow-lg md:bg-white md:rounded-lg">
              <div class="md:w-6/12 lg:w-5/12">
                <img class="rounded-lg md:rounded-r-none w-full h-full object-cover object-left" src="<?php echo $item['picture'];?>">
              </div>
              <div class="relative self-center mx-2 md:mx-0 p-2 md:p-4 shadow-lg md:shadow-none bg-white md:bg-transparent rounded-lg md:rounded-l-none -mt-2 md:mt-0 md:w-6/12 lg:w-7/12">
                <h2 class="text-xl tracking-tight font-semibold uppercase text-secondary mb-2">
                <?php echo $item['name'];?>
                </h2>
                <p class="text-gray-700 leading-snug">
                <?php echo $item['description']; ?>
                </p>
                <span class="mt-2 text-sm font-semibold text-gray-800 block">
                $<?php echo $item['price']; ?>
                </span>
                <form method="post">
            <input name="customizepizza" type="hidden"></input>
            <input name="id" type="hidden" value="<?php echo $item['id']; ?>"></input>
            <?php if(order::addedTopping($item['id'])):?>
		      <input name="delete" type="hidden"></input>     
            <button class="text-center w-full text-sm bg-red-700 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Remove Item</button>
            <?php else: ?>
            <input name="insert" type="hidden"></input>     
            <button class="text-center w-full text-sm bg-blue-500 rounded py-2 text-white mt-2" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Add Item</button>
            <?php endif; ?>            
            </form>
              </div>
            </div>
          </div>
          <?php endforeach; ?>	
		<?php endif;?>
		
		
		
		
		
		
		
		
		
		
		
		
		
        </div>
      </section>
		<li>
		<button onclick="window.location.href='./continue?type=<?php if(isset($_GET['type'])){echo $_GET['type'];}?>'" class="mt-2 block flex mx-auto mt-10 md:ml-auto md:mr-32 uppercase shadow bg-blue-500 transition  hover:bg-blue-600 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Continue</button>
		</li>
    </ul>
  </div>
</div>
</main>
   </div>
    <footer>
  <!-- Foooter -->
  <section class="bg-white">
    <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
    <nav class="flex border md:border-none flex-col text-center md:flex md:flex-row flex-wrap justify-center -mx-5 -my-2 ">
        <div class="px-5 py-2"> <a href="./" class="text-base leading-6 text-gray-500 hover:text-gray-900">
          Home
        </a> </div>
        <div class="md:hidden">
          <hr>
        </div>
        <div class="px-5 py-2"> <a href="admin" class="text-base leading-6 text-gray-500 hover:text-gray-900">
          Admin
        </a> </div>        
        <div class="md:hidden">
          <hr>
        </div>
        <div class="px-5 py-2"> <a href="logout" class="text-base leading-6 text-gray-500 hover:text-gray-900">
          Log out
        </a> </div>
        <div class="md:hidden">
          <hr>
        </div>
      </nav>
      <div class="flex justify-center mt-8 space-x-6">
        <a href="https://github.com/cheesea3" class="text-gray-400 hover:text-gray-500"> <span class="sr-only">GitHub</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd"></path>
          </svg>
        </a>
      </div>
      <p class="mt-8 text-base leading-6 text-center text-gray-400"> © 2021 Food Engine, Inc. All rights reserved. </p>
    </div>
  </section>
</footer>







   


<?php 
session_start();

?>



<style>
button, input[type="submit"], input[type="reset"] {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}
</style>




