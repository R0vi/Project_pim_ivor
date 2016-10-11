<?php
class StockChange{

    // this function constructs a new Stock change instance
    private $db;

    public function __construct(Connection $connection)
    {
        $this->db = $connection;
    }

    // this function handles adding to stock
    public function addToStock($product, $amount)
    {
      // getting the old amount
      $oldAmount = $this->checkStockItem($product);
      // adding the new amount to the old one
      $newAmount = $amount + $oldAmount;
      // placing the new amount in the db
      $query = $this->db->prepare('UPDATE `products` SET aantal = :amount WHERE product = :product');
      $query->execute(array(':product' => $product, ':amount' => $newAmount ));

    }

    // this function handles removing items from stock
    public function removeFromStock($product, $amount)
    {
      // getting the old amount
      $oldAmount = $this->checkStockItem($product);
      // subtracting the specified amount of products form the old value
      $newAmount = $oldAmount-$amount;
      // checking if a warning should be issued
      $warning = $this->checkForWarning($product, $newAmount ,$oldAmount);

      if($warning){
        $theWarning = "The stock of this product is to low now";
      } else {
        $theWarning = "all good";
      }

      // change the db to contain the new amount of the product
      $query = $this->db->prepare('UPDATE `products` SET aantal = :amount WHERE product = :product');
      $query->execute(array(':product' => $product, ':amount' => $newAmount ));

      return $theWarning;
    }

    // this function checks if a warning needs to be issued for low running stock
    public function checkForWarning($product, $newAmount)
    {
      // get warning amount
      $query = $this->db->prepare('SELECT waarschuwing FROM products WHERE product = :product');
      $query->execute(array(':product' => $product ));
      $warningAmount = $query->fetch();

      if( $newAmount < $warningAmount ){
        return true;
      }else {
        return false;
      }

    }

    // returns how much of this item is in stock
    public function checkStockItem($product){
      $query = $this->db->prepare('SELECT aantal FROM products WHERE product = :product');
      $query->execute(array(':product' => $product));
      $result = $query->fetch();
      return $result['aantal'];
    }

    // returns an array containing all stock
    public function returnTotalStock(){
      $query = $this->db->prepare('SELECT * FROM products');
      $query->execute();
      $result = $query->fetchall();
      return $result;
    }
}
