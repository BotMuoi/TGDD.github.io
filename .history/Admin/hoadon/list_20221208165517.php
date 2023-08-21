<?php
    $bill = bill_selectAll();
    $i = 0;
?>
<div class="list__container">
    <h1 class="list__heading">Danh sách đơn hàng</h1>
    <form action="index.php?bill&act=update_status" method="post">
    <?php 
        if(isset($noti)&&$noti!="") echo "<p class='add__noti'> $noti </p>"
    ?>
    <table border="1">
        <thead>
            <tr>    
                <th colspan="2">Tên khách hàng</th>
                <th>Sản phẩm</th>
                <th colspan="2">Tình trạng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($bill as $dh){
                    extract($dh);
                    $user = kh_getinfo($ma_kh);
                    $bill_detail = orderBill_selectOneByIdBill($ma_bil);
                    $danhsachchitiet = bill_detailSelectAllByIdBill($ma_bil);
                    ?>
                    <tr>
                        <td>
                            <input class="list__checkbox" type="checkbox">
                        </td>
                        <td >
                            <input type="text" name="id_bill[]"readonly value="<?=$ma_bil?>" style="width: 30px; font-size: 16px; background-color: transparent; display: none">
                            <?=$user['username']?>
                        </td>
                        <td>
                            <?php $pro = hh_getinfo($bill_detail['ma_hh']);
                             echo $pro['ten_hh'];
                            ?>    
                        </td>
                        <td>
                            <select name="status[]" id="" style=" width:9rem ">
                                <option value="0" <?php $select = $trangthai==0?'selected':''; echo $select?>>Đang đóng gói</option>
                                <option value="1" <?php $select = $trangthai==1?'selected':''; echo $select?>>Đang vận chuyển</option>
                                <option value="2" <?php $select = $trangthai==2?'selected':''; echo $select?>>Đã hoàn tất</option>
                                <option value="3" <?php $select = $trangthai==3?'selected':''; echo $select?>>Đã hủy</option>
                            </select>
                            <div class="bill__detail--contain" data-bill="<?=$i?>"></div>
                            
                        </td>
                        <td class="list__action--container">
                            <div class="list__action">
                                <label for="">Xem chi tiết</label>
                                <a href="<?=$ADMIN_URL?>/index.php?page=hoadon&act=del&id=<?=$ma_bil?>"><button type="button">Xóa</button></a>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        foreach($danhsachchitiet as $hoadonchitiet){
                            $hanghoa = hh_selectAllById($hoadonchitiet['ma_hh']);
                    ?>
                    <tr>
                            
                    </tr>
                    <?php } ?>
                <?php $i++; }?>
        </tbody>
    </table>
    <button id="select_all" class="admin_btn" type="button">Chọn tất cả</button>
    <button id="unselect_all" class="admin_btn" type="button">Bỏ chọn tất cả</button>
    <button class="admin_btn" type="button">Xóa các mục đã chọn</button>
    <input type="submit" value="Lưu" class="admin_btn">
    </form>
</div>

