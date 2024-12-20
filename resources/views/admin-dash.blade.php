<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/admin-dash.css">
    <title>Admin</title>
</head>
<body>
<main>  
<div class="mainContainer">
            <div class="productDisplay">
                <div class="delAddProduct">
    
                    <div class="searchBar">
                        <input type="text" id="search" placeholder="Search">
                    </div>
                    <button class="inventoryLogBtn" id="inventory_LogBtn">Inventory Log </button>
                    <button class="removeProduct" id="removeProductBtn">Delete  Book</button>
                    <button class="addProduct" id="addProductBtn">Add Book</button>
                </div>
                <form class="genre" id="genreContainer" name="form"
                    action="" method="post">
                    <button class="genreBtn" type="submit" name="genre" value="All">All</button>
                    <button class="genreBtn" type="submit" name="genre" value="Action">Action</button>
                    <button class="genreBtn" type="submit" name="genre" value="Fantasy">Fantasy</button>
                    <button class="genreBtn" type="submit" name="genre" value="Romance">Romance</button>
                    <button class="genreBtn" type="submit" name="genre" value="Adventure">Adventure</button>
                    <button class="genreBtn" type="submit" name="genre" value="Fiction">Fiction</button>
                    <button class="genreBtn" type="submit" name="genre" value="Science-Fiction">Science-Fiction</button>
                    <button class="genreBtn" type="submit" name="genre" value="Mystery">Mystery</button>
                    <button class="genreBtn" type="submit" name="genre" value="Thriller">Thriller</button>
                    <button class="genreBtn" type="submit" name="genre" value="Literary Fiction">Literary Fiction</button>
                    <button class="genreBtn" type="submit" name="genre" value="Historical Fiction">Historical Fiction</button>
                    <button class="genreBtn" type="submit" name="genre" value="Contemporary">Contemporary</button>
                    <button class="genreBtn" type="submit" name="genre" value="Crime Fiction">Crime Fiction</button>
                    <button class="genreBtn" type="submit" name="genre" value="Drama">Drama</button>
                    <button class="genreBtn" type="submit" name="genre" value="Psychology">Psychology</button>
                    <button class="genreBtn" type="submit" name="genre" value="Travel">Travel</button>
                    <button class="genreBtn" type="submit" name="genre" value="True Crime">True Crime</button>
                </form>
    
                <div class="inventory">
                    <table class="inventoryTable">
                        <thead>
                            <tr>
                                <th></th> 
                                <th>BookID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>genre</th>
                                <th>Description</th>
                                <th>cover</th>
                                <th>created_at</th>
                                <th>updated_at</th>
                                <th>release_date</th>
                            </tr>
                        </thead>
                        <tbody>
                                      
                                    
                        </tbody>
                    </table>
    
                    <form id="removeProductForm" name="form" action="" method="post">
                        <input type="hidden" id="selectedProducts" name="selectedProducts">
                    </form>
                </div>
            </div>
        </div>
    
    </main>
</body>
</html>