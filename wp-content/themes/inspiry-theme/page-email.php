<?php get_header();?>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

</style>
<?php 

    if (strstr($_SERVER['SERVER_NAME'], 'localhost')){
        $order = wc_get_order( 15389 );
    }
   

    $tracking = $order->get_meta('_wc_shipment_tracking_items'); 
   
    
  
?>
<section class="email-template processing-order">
    <div class="header max-width padding">
        <div class="logo">
            <img src="<?php echo site_url();?>/wp-content/uploads/2020/11/Inspiry_Logo-transparent-1.png" alt="Inspiry Logo">
        </div>
        <div class="store">
            <div>
                <a href="https://inspiry.co.nz/products" target="_blank">Store</a>
            </div>
            <div> <a href="https://inspiry.co.nz/products" target="_blank"><img src="https://inspiry.co.nz/wp-content/uploads/2021/05/shopping-cart.png" alt="Cart Icon"></a> </div>
        </div>
    </div>
    <!-- body  -->
    <div class="body max-width padding">
        <div class="text-content">
            <!-- change the status here -->
            <h1 class="title playfair-fonts">Your Inspiry order has shipped.</h1>
            <div class="divider">
                <img src="https://inspiry.co.nz/wp-content/uploads/2021/05/delivery-truck.png" alt="delivery">
            </div>

            <!-- tracking number -->
            <h2 class="subtitle playfair-fonts">Your order has been shipped. Your tracking number is <?php     print_r($tracking[0]['tracking_number']); ?></h2>
            
            <!-- only for when item is shipped  -->
            
            <?php 
            // create a tracking url
                $trackingUrl; 

                if($tracking[0]['tracking_provider']=== 'NZ Post'){
                    $trackingUrl = 'https://www.nzpost.co.nz/tools/tracking?trackid='.$tracking[0]['tracking_number']; 
                }
            ?>
            <h3 class="paragraph playfair-fonts">Use this link to track your package: <a class="playfair-fonts" href="<?php echo $trackingUrl;?>" target="_blank">Track  </a></h3>
        </div>
    </div>

    <div class="order-container max-width">
        <div class="order-content"> 
            <div class="text-content">
                <!-- change it depeding on a email template  -->
                <h4 class="playfair-fonts">Here's what we shipped:</h4>
                <!-- change above -->
                <div class="meta">
                    <div class="order-number">Order #: <?php echo $order->get_id();?></div>
                    <div class="order-date">Order Date: <?php 

                    // format date  
                    $justDate = strtotime($order->order_date);
                    echo date('d-m-Y',$justDate);

                    ?></div>
                </div>
            </div>

            <div class="product-cards max-width padding">
                <div class="card">
                    <table>
                        <tr>
                            <th class="playfair-fonts">Item</th>
                            <th class="playfair-fonts">Qty</th>
                            <th class="playfair-fonts">Price</th>
                        </tr>
                        <?php 
                        
                            $count = 1;
                            foreach( $order->get_items() as $item_id => $line_item ){
                                $item_data = $line_item->get_data();
                                $product = $line_item->get_product();
                                $product_name = $product->get_name();
                                $productID = $product->get_id();
                                $item_quantity = $line_item->get_quantity();
                                $item_total = $line_item->get_total();
                                $metadata['Line Item '.$count] = 'Product name: '.$product_name.' | Quantity: '.$item_quantity.' | Item total: '. number_format( $item_total, 2 );
                                $count += 1;
                                ?>
                                <tr class="items">
                                    <td class="playfair-fonts title"> <a href="<?php echo  get_the_permalink($productID);?>" target="_blank"><span><img src="<?php echo get_the_post_thumbnail_url($productID, 'thumbnail');?>" alt=""></span> <span class="playfair-fonts"><?php echo $product_name; ?></span></a> </td>
                                    <td class="playfair-fonts"><?php echo $item_quantity;?></td>
                                    <td class="playfair-fonts">
                                       $<?php echo round($item_total, 2); ?>
                                    </td>
                                </tr>


                                <?php 
                            }
                        
                        ?>
                        
                        
                        </tr>
                    </table>
                </div>
                
            </div>
            <div class="customer-contact">
                <div class="playfair-fonts">Sent to:</div>
                <div class="contact-info">
                    <span class="playfair-fonts"><?php  echo $order->get_shipping_first_name();?> <?php echo $order->get_shipping_last_name();?></span>
                    <span class="playfair-fonts"><?php echo $order->get_shipping_address_1();?></span>
                    <span class="playfair-fonts"><?php echo  $order->get_shipping_city();?></span>
                    <span class="playfair-fonts"><?php echo  $order->get_shipping_postcode();?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="footer max-width padding">
        <div class="playfair-fonts">Need help with your order? Please <a href="https://inspiry.co.nz/contact" target="_blank"> contact us</a>.</div>
    </div>
</section>
<!-- <img src="http://localhost/inspiry/wp-content/uploads/2021/05/image004.jpg" alt="">
    <img src="http://localhost/inspiry/wp-content/uploads/2021/05/image005.jpg" alt=""> -->
 





<?php get_footer(); ?>
