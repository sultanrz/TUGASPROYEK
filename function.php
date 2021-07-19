<?php

$conn = mysqli_connect("localhost","root","","tugasproyek");

if(isset($_POST['addnew'])){
    $namabarang = $_POST['namabarang'];
    $deskripsi =$_POST['deskripsi'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn,"insert into stockbarang (namabarang, deskripsi, stock) values('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');
    }
}
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $penerima =$_POST['penerima'];
    $qty = $_POST['qty'];
    $cekstocksekarang = mysqli_query($conn,"select *from stockbarang where idbarang= '$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang) ;

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

    $addtomasuk = mysqli_query($conn,"insert into masuk(idbarang,keterangan,qty) values('$barangnya','$penerima','$qty')");
    $updatestockmasuk = mysqli_query($conn,"update stock set stock= '$tambahkanstocksekarangdenganquantity'where idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header('location:masuk.php');
    }else{
        echo 'Gagal';
        header('location:masuk.php');
    }
}
?>