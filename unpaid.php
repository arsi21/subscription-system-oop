<?php
include_once("includes/check-access.php");
include "lib/dbh.php";
include "models/invoices.php";
include "views/invoices-view.php";

//check access
if(!checkIfRegular()){
    header("location:index.php");
}

//Instantiate Class
$invoicesView = new InvoicesView();

//start session
if(!isset($_SESSION)){
    session_start();
}

$id = $_SESSION['id'];

//get data from database
$unpaidInvoicesData = $invoicesView->showUnpaidInvoices($id);
$unpaidInvoicesCount = $invoicesView->showUnpaidInvoicesCount($id);
?>

<?php include_once("partials/header.php");?>

<div class="container">
    <p class="mt-3 text-muted">Unpaid Subscription</p>

    <div class="mb-5 overflow-auto">
        <table class="table caption-top table-hover">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Product Name</th>
                <th scope="col">Balance</th>
                <th scope="col">Due date</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php //output data
            foreach($unpaidInvoicesData as $row){ ?>
                <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['subscription_name']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['pay_by']; ?></td>
                <td><a type="button" class="btn btn-primary btn-sm" href="payment.php?invoice_id=<?php echo $row['id']; ?>">pay</a></td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <?php
            if($unpaidInvoicesCount <= 0){
                echo
                    '<p class="lead text-center">
                        No data found!
                    </p>';
            }
        ?>
    </div>
</div>
    
        
<?php include_once("partials/footer.php") ?>