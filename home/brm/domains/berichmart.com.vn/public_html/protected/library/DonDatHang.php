<?php
// nguoi
class Nguoi{
   /**
     * @var string post fullname
     * @soap
     */
    public $fullname;
    /**
     * @var int post sex
     * @soap
     */
    public $sex;
    /**
     * @var string post address
     * @soap
     */
    public $address;
    /**
     * @var string post email
     * @soap
     */
    public $email;
    /**
     * @var string post phone
     * @soap
     */
    public $phone; 
    /**
     * @var string post mobile
     * @soap
     */
    public $mobile; 
    /**
     * @var string post fax
     * @soap
     */
    public $fax; 
    /**
     * @var string post info
     * @soap
     */
    public $info; 
}

// san pham dat
class SPDat{
   /**
     * @var string post MaSP
     * @soap
     */
    public $MaSP;
    /**
     * @var string post TenSP
     * @soap
     */
    public $TenSP;
    /**
     * @var int post SoLuong
     * @soap
     */
    public $SoLuong;
    /**
     * @var int post GiaBan
     * @soap
     */
    public $GiaBan;
    /**
     * @var int post TongTien
     * @soap
     */
    public $TongTien; 
    /**
     * @var float post TongDiem
     * @soap
     */
    public $TongDiem; 
}

// don hang
class DonDatHang{
    /**
     * @var int post MaDDH
     * @soap
     */
    public $MaDDH;
    /**
     * @var int post Member_id
     * @soap
     */
    public $Member_id;
    /**
     * @var int post TongTien
     * @soap
     */
    public $TongTien;
    /**
     * @var int post HoaHongTieuDung
     * @soap
     */
    public $HoaHongTieuDung;
    /**
     * @var int post TongTienThanhToan
     * @soap
     */
    public $TongTienThanhToan;
    /**
     * @var float post TongDiem
     * @soap
     */
    public $TongDiem;
    /**
     * @var string post NgayDat
     * @soap
     */
    public $NgayDat;
    /**
     * @var Nguoi post NguoiMua
     * @soap
     */
    public $NguoiMua;
    /**
     * @var Nguoi post NguoiNhan
     * @soap
     */
    public $NguoiNhan;
    /**
     * @var SPDat[] post HangDat
     * @soap
     */
    public $HangDat;
    /**
     * @var int post TrangThai
     * @soap
     */
    public $TrangThai;
    
}
?>
