<table class="form_table" cellpadding="0" cellspacing="0" align="center">
          <tbody>
          	<tr>
            	<td colspan="2"><h3>Thông tin tài khoản</h3></td>
            </tr>
            <tr>
              <td class="form_name_top"><span class="form_asterisk">*</span> Tên truy cập :</td>
              <td class="form_text">
              <div>
                  <input title="Tên truy cập" type="text" >
                  <span id="Check_button"><input type="button" onclick="getAccountName(1)" value="Kiểm tra"></span>
                </div>
                <div class="form_text_warning">
                  <div class="check_availability hidden"></div>
                  - Tên truy cập phải có ít nhất 4 ký tự (chữ, số, ký tự _, viết liền, không dấu).<br>
               </div></td>
            </tr>
            <tr>
              <td class="form_name_top"><span class="form_asterisk">*</span> Mật khẩu :</td>
              <td class="form_text"><div>
                  <input title="Mật khẩu" type="password" class="form_control" id="use_password" name="use_password" maxlength="50" style="width:300px" onblur="checkPasswordMatch()">
                </div>
                <div class="form_text_warning"> - Mật khẩu phải có ít nhất 6 ký tự</div></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Xác nhận mật khẩu :</td>
              <td class="form_text"><input class="form_control" type="password" title="Xác nhận mật khẩu" id="use_confirm_password" name="use_confirm_password" value="" style="width:300px; height:px" maxlength="50"></td>
            </tr>
            	<tr>
            	<td colspan="2"><h3>Thông tin cá nhân</h3></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Họ và tên :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Họ và tên" id="use_name" name="use_name" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
             <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Giới tính :</td>
              <td class="form_text"><select class="form_control" title="Giới tính" id="use_gender" name="use_gender" style="width:px" size="1">
                  <option title="- Chọn -" value="-1" selected="selected">- Chọn -</option>
                  <option title="Nam" value="1">Nam</option>
                  <option title="Nữ" value="0">Nữ</option>
                </select></td>
            </tr>
            <tr>
              <td class="form_name"><span class="form_asterisk">*</span> Ngày sinh :</td>
              <td class="form_text"><select class="form_control" id="birth_day" name="birth_day">
                  <option value="0">Ngày</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
                -
                <select class="form_control" id="birth_month" name="birth_month">
                  <option value="0">Tháng</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
                -
                <select class="form_control" id="birth_year" name="birth_year">
                  <option value="0">Năm</option>
                  <option value="1950">1950</option>
                  <option value="1951">1951</option>
                  <option value="1952">1952</option>
                  <option value="1953">1953</option>
                  <option value="1954">1954</option>
                  <option value="1955">1955</option>
                  <option value="1956">1956</option>
                  <option value="1957">1957</option>
                  <option value="1958">1958</option>
                  <option value="1959">1959</option>
                  <option value="1960">1960</option>
                  <option value="1961">1961</option>
                  <option value="1962">1962</option>
                  <option value="1963">1963</option>
                  <option value="1964">1964</option>
                  <option value="1965">1965</option>
                  <option value="1966">1966</option>
                  <option value="1967">1967</option>
                  <option value="1968">1968</option>
                  <option value="1969">1969</option>
                  <option value="1970">1970</option>
                  <option value="1971">1971</option>
                  <option value="1972">1972</option>
                  <option value="1973">1973</option>
                  <option value="1974">1974</option>
                  <option value="1975">1975</option>
                  <option value="1976">1976</option>
                  <option value="1977">1977</option>
                  <option value="1978">1978</option>
                  <option value="1979">1979</option>
                  <option value="1980">1980</option>
                  <option value="1981">1981</option>
                  <option value="1982">1982</option>
                  <option value="1983">1983</option>
                  <option value="1984">1984</option>
                  <option value="1985">1985</option>
                  <option value="1986">1986</option>
                  <option value="1987">1987</option>
                  <option value="1988">1988</option>
                  <option value="1989">1989</option>
                  <option value="1990">1990</option>
                  <option value="1991">1991</option>
                  <option value="1992">1992</option>
                  <option value="1993">1993</option>
                  <option value="1994">1994</option>
                  <option value="1995">1995</option>
                  <option value="1996">1996</option>
                  <option value="1997">1997</option>
                  <option value="1998">1998</option>
                  <option value="1999">1999</option>
                  <option value="2000">2000</option>
                  <option value="2001">2001</option>
                  <option value="2002">2002</option>
                  <option value="2003">2003</option>
                  <option value="2004">2004</option>
                  <option value="2005">2005</option>
                  <option value="2006">2006</option>
                  <option value="2007">2007</option>
                  <option value="2008">2008</option>
                  <option value="2009">2009</option>
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                </select>
                (dd-mm-yyyy) </td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Địa chỉ hiện tại :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Email" id="use_email" name="use_email" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Tỉnh/ Thành phố :</td>
              <td class="form_text"><select class="form_control" title="Chọn" id="use_province" name="use_province" style="width:px" size="1" onchange="$('#use_province_2').val(this.value)">
                  <option value="">--[Chọn]--</option>
                  <option title="Hà Nội" value="2">Hà Nội</option>
                  <option title="Hồ Chí Minh" value="3">Hồ Chí Minh</option>
                  <option title="Hải Phòng" value="32">Hải Phòng</option>
                  <option title="Đà Nẵng" value="65">Đà Nẵng</option>
                  <option title="An Giang" value="4">An Giang</option>
                  <option title="Bà Rịa - Vũng Tàu" value="5">Bà Rịa - Vũng Tàu</option>
                  <option title="Bắc Cạn" value="14">Bắc Cạn</option>
                  <option title="Bắc Giang" value="7">Bắc Giang</option>
                  <option title="Bạc Liêu" value="12">Bạc Liêu</option>
                  <option title="Bắc Ninh" value="6">Bắc Ninh</option>
                  <option title="Bến Tre" value="13">Bến Tre</option>
                  <option title="Bình Dương" value="8">Bình Dương</option>
                  <option title="Bình Phước" value="10">Bình Phước</option>
                  <option title="Bình Thuận" value="11">Bình Thuận</option>
                  <option title="Bình Định" value="9">Bình Định</option>
                  <option title="Buôn Mê Thuột" value="66">Buôn Mê Thuột</option>
                  <option title="Cà Mau" value="24">Cà Mau</option>
                  <option title="Cần Thơ" value="15">Cần Thơ</option>
                  <option title="Cao Bằng" value="25">Cao Bằng</option>
                  <option title="Gia Lai" value="26">Gia Lai</option>
                  <option title="Hà Giang" value="27">Hà Giang</option>
                  <option title="Hà Nam" value="28">Hà Nam</option>
                  <option title="Hà Nội 2" value="29">Hà Nội 2</option>
                  <option title="Hà Tĩnh" value="30">Hà Tĩnh</option>
                  <option title="Hải Dương" value="31">Hải Dương</option>
                  <option title="Hậu Giang" value="68">Hậu Giang</option>
                  <option title="Hoà Bình" value="33">Hoà Bình</option>
                  <option title="Hưng Yên" value="34">Hưng Yên</option>
                  <option title="Khánh Hòa" value="17">Khánh Hòa</option>
                  <option title="Kiên Giang" value="35">Kiên Giang</option>
                  <option title="Kon Tum" value="36">Kon Tum</option>
                  <option title="Lai Châu" value="37">Lai Châu</option>
                  <option title="Lâm Đồng" value="38">Lâm Đồng</option>
                  <option title="Lạng Sơn" value="39">Lạng Sơn</option>
                  <option title="Lào Cai" value="20">Lào Cai</option>
                  <option title="Long An" value="40">Long An</option>
                  <option title="Nam Định" value="23">Nam Định</option>
                  <option title="Nghệ An" value="41">Nghệ An</option>
                  <option title="Ninh Bình" value="42">Ninh Bình</option>
                  <option title="Ninh Thuận" value="43">Ninh Thuận</option>
                  <option title="Phú Thọ" value="44">Phú Thọ</option>
                  <option title="Phú Yên" value="45">Phú Yên</option>
                  <option title="Quảng Bình" value="46">Quảng Bình</option>
                  <option title="Quảng Nam" value="47">Quảng Nam</option>
                  <option title="Quảng Ngãi" value="48">Quảng Ngãi</option>
                  <option title="Quảng Ninh" value="21">Quảng Ninh</option>
                  <option title="Quảng Trị" value="49">Quảng Trị</option>
                  <option title="Sóc Trăng" value="50">Sóc Trăng</option>
                  <option title="Sơn La" value="51">Sơn La</option>
                  <option title="Tây Ninh" value="52">Tây Ninh</option>
                  <option title="Thái Bình" value="53">Thái Bình</option>
                  <option title="Thái Nguyên" value="54">Thái Nguyên</option>
                  <option title="Thanh Hoá" value="55">Thanh Hoá</option>
                  <option title="Thừa Thiên Huế" value="19">Thừa Thiên Huế</option>
                  <option title="Tiền Giang" value="56">Tiền Giang</option>
                  <option title="Trà Vinh" value="57">Trà Vinh</option>
                  <option title="Tuyên Quang" value="58">Tuyên Quang</option>
                  <option title="Vĩnh Long" value="59">Vĩnh Long</option>
                  <option title="Vĩnh Phúc" value="60">Vĩnh Phúc</option>
                  <option title="Yên Bái" value="61">Yên Bái</option>
                  <option title="Đà Lạt" value="69">Đà Lạt</option>
                  <option title="Đắc Lắc" value="62">Đắc Lắc</option>
                  <option title="Đắc Nông" value="67">Đắc Nông</option>
                  <option title="Đồng Nai" value="22">Đồng Nai</option>
                  <option title="Đồng Tháp" value="64">Đồng Tháp</option>
                </select></td>
            </tr>
            <tr>
            	<td colspan="2"><h3>Thông tin chứng thực</h3></td>
            </tr>
             <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Số CMND :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Email" id="use_email" name="use_email" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
              <tr>
              <td class="form_name"><span class="form_asterisk">*</span> Ngày cấp :</td>
              <td class="form_text"><select class="form_control" id="birth_day" name="birth_day">
                  <option value="0">Ngày</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
                -
                <select class="form_control" id="birth_month" name="birth_month">
                  <option value="0">Tháng</option>
                  <option value="1">01</option>
                  <option value="2">02</option>
                  <option value="3">03</option>
                  <option value="4">04</option>
                  <option value="5">05</option>
                  <option value="6">06</option>
                  <option value="7">07</option>
                  <option value="8">08</option>
                  <option value="9">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
                -
                <select class="form_control" id="birth_year" name="birth_year">
                  <option value="0">Năm</option>
                  <option value="1950">1950</option>
                  <option value="1951">1951</option>
                  <option value="1952">1952</option>
                  <option value="1953">1953</option>
                  <option value="1954">1954</option>
                  <option value="1955">1955</option>
                  <option value="1956">1956</option>
                  <option value="1957">1957</option>
                  <option value="1958">1958</option>
                  <option value="1959">1959</option>
                  <option value="1960">1960</option>
                  <option value="1961">1961</option>
                  <option value="1962">1962</option>
                  <option value="1963">1963</option>
                  <option value="1964">1964</option>
                  <option value="1965">1965</option>
                  <option value="1966">1966</option>
                  <option value="1967">1967</option>
                  <option value="1968">1968</option>
                  <option value="1969">1969</option>
                  <option value="1970">1970</option>
                  <option value="1971">1971</option>
                  <option value="1972">1972</option>
                  <option value="1973">1973</option>
                  <option value="1974">1974</option>
                  <option value="1975">1975</option>
                  <option value="1976">1976</option>
                  <option value="1977">1977</option>
                  <option value="1978">1978</option>
                  <option value="1979">1979</option>
                  <option value="1980">1980</option>
                  <option value="1981">1981</option>
                  <option value="1982">1982</option>
                  <option value="1983">1983</option>
                  <option value="1984">1984</option>
                  <option value="1985">1985</option>
                  <option value="1986">1986</option>
                  <option value="1987">1987</option>
                  <option value="1988">1988</option>
                  <option value="1989">1989</option>
                  <option value="1990">1990</option>
                  <option value="1991">1991</option>
                  <option value="1992">1992</option>
                  <option value="1993">1993</option>
                  <option value="1994">1994</option>
                  <option value="1995">1995</option>
                  <option value="1996">1996</option>
                  <option value="1997">1997</option>
                  <option value="1998">1998</option>
                  <option value="1999">1999</option>
                  <option value="2000">2000</option>
                  <option value="2001">2001</option>
                  <option value="2002">2002</option>
                  <option value="2003">2003</option>
                  <option value="2004">2004</option>
                  <option value="2005">2005</option>
                  <option value="2006">2006</option>
                  <option value="2007">2007</option>
                  <option value="2008">2008</option>
                  <option value="2009">2009</option>
                  <option value="2010">2010</option>
                  <option value="2011">2011</option>
                  <option value="2012">2012</option>
                </select>
                (dd-mm-yyyy) </td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Nơi cấp :</td>
              <td class="form_text"><select onchange="$('#use_province_2').val(this.value)" size="1" style="width:px" name="use_province" id="use_province" title="Chọn" class="form_control">
                  <option value="">--[Chọn]--</option>
                  <option value="2" title="Hà Nội">Hà Nội</option>
                  <option value="3" title="Hồ Chí Minh">Hồ Chí Minh</option>
                  <option value="32" title="Hải Phòng">Hải Phòng</option>
                  <option value="65" title="Đà Nẵng">Đà Nẵng</option>
                  <option value="4" title="An Giang">An Giang</option>
                  <option value="5" title="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
                  <option value="14" title="Bắc Cạn">Bắc Cạn</option>
                  <option value="7" title="Bắc Giang">Bắc Giang</option>
                  <option value="12" title="Bạc Liêu">Bạc Liêu</option>
                  <option value="6" title="Bắc Ninh">Bắc Ninh</option>
                  <option value="13" title="Bến Tre">Bến Tre</option>
                  <option value="8" title="Bình Dương">Bình Dương</option>
                  <option value="10" title="Bình Phước">Bình Phước</option>
                  <option value="11" title="Bình Thuận">Bình Thuận</option>
                  <option value="9" title="Bình Định">Bình Định</option>
                  <option value="66" title="Buôn Mê Thuột">Buôn Mê Thuột</option>
                  <option value="24" title="Cà Mau">Cà Mau</option>
                  <option value="15" title="Cần Thơ">Cần Thơ</option>
                  <option value="25" title="Cao Bằng">Cao Bằng</option>
                  <option value="26" title="Gia Lai">Gia Lai</option>
                  <option value="27" title="Hà Giang">Hà Giang</option>
                  <option value="28" title="Hà Nam">Hà Nam</option>
                  <option value="29" title="Hà Nội 2">Hà Nội 2</option>
                  <option value="30" title="Hà Tĩnh">Hà Tĩnh</option>
                  <option value="31" title="Hải Dương">Hải Dương</option>
                  <option value="68" title="Hậu Giang">Hậu Giang</option>
                  <option value="33" title="Hoà Bình">Hoà Bình</option>
                  <option value="34" title="Hưng Yên">Hưng Yên</option>
                  <option value="17" title="Khánh Hòa">Khánh Hòa</option>
                  <option value="35" title="Kiên Giang">Kiên Giang</option>
                  <option value="36" title="Kon Tum">Kon Tum</option>
                  <option value="37" title="Lai Châu">Lai Châu</option>
                  <option value="38" title="Lâm Đồng">Lâm Đồng</option>
                  <option value="39" title="Lạng Sơn">Lạng Sơn</option>
                  <option value="20" title="Lào Cai">Lào Cai</option>
                  <option value="40" title="Long An">Long An</option>
                  <option value="23" title="Nam Định">Nam Định</option>
                  <option value="41" title="Nghệ An">Nghệ An</option>
                  <option value="42" title="Ninh Bình">Ninh Bình</option>
                  <option value="43" title="Ninh Thuận">Ninh Thuận</option>
                  <option value="44" title="Phú Thọ">Phú Thọ</option>
                  <option value="45" title="Phú Yên">Phú Yên</option>
                  <option value="46" title="Quảng Bình">Quảng Bình</option>
                  <option value="47" title="Quảng Nam">Quảng Nam</option>
                  <option value="48" title="Quảng Ngãi">Quảng Ngãi</option>
                  <option value="21" title="Quảng Ninh">Quảng Ninh</option>
                  <option value="49" title="Quảng Trị">Quảng Trị</option>
                  <option value="50" title="Sóc Trăng">Sóc Trăng</option>
                  <option value="51" title="Sơn La">Sơn La</option>
                  <option value="52" title="Tây Ninh">Tây Ninh</option>
                  <option value="53" title="Thái Bình">Thái Bình</option>
                  <option value="54" title="Thái Nguyên">Thái Nguyên</option>
                  <option value="55" title="Thanh Hoá">Thanh Hoá</option>
                  <option value="19" title="Thừa Thiên Huế">Thừa Thiên Huế</option>
                  <option value="56" title="Tiền Giang">Tiền Giang</option>
                  <option value="57" title="Trà Vinh">Trà Vinh</option>
                  <option value="58" title="Tuyên Quang">Tuyên Quang</option>
                  <option value="59" title="Vĩnh Long">Vĩnh Long</option>
                  <option value="60" title="Vĩnh Phúc">Vĩnh Phúc</option>
                  <option value="61" title="Yên Bái">Yên Bái</option>
                  <option value="69" title="Đà Lạt">Đà Lạt</option>
                  <option value="62" title="Đắc Lắc">Đắc Lắc</option>
                  <option value="67" title="Đắc Nông">Đắc Nông</option>
                  <option value="22" title="Đồng Nai">Đồng Nai</option>
                  <option value="64" title="Đồng Tháp">Đồng Tháp</option>
                </select></td>
            </tr>
             <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Số điện thoại :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Email" id="use_email" name="use_email" value="" style="width:300px; height:px" maxlength="255">
                <div class="form_text_warning">Số điên thoại đang sử dụng (Không cần nhập số 0 đầu tiên) - có thể là số máy bàn hoặc số di động khác.</div></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Email :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Email" id="use_email" name="use_email" value="" style="width:300px; height:px" maxlength="255">
                <div class="form_text_warning">Email bạn nhập phải tồn tại, chúng tôi sẽ gửi mã kích hoạt vào email đó.</div></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Xác nhận Email :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Xác nhận Email" id="use_confirm_email" name="use_confirm_email" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
             <tr>
            	<td colspan="2"><h3>Thông tin người giới thiệu</h3></td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Người giới thiệu 1 :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Nick Yahoo" id="use_yahoo" name="use_yahoo" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
            <tr>
              <td class="form_name" valign="top">Tên người giới thiệu:</td>
              <td class="form_text"><span style="color:#0073AE; font-weight:bold;">Nguyễn Hữu Thành</span>
               <div class="form_text_warning">Nhập đúng tài khoản người giới thiệu, người giới thiệu sẽ không được thay đổi trong bất kỳ trường hợp nào.</div>
              </td>
            </tr>
          	    <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Người giới thiệu 2 :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Nick Yahoo" id="use_yahoo" name="use_yahoo" value="" style="width:300px; height:px" maxlength="255"></td>
            </tr>
            <tr>
              <td class="form_name" valign="top">Tên người giới thiệu:</td>
              <td class="form_text"><span style="color:#0073AE; font-weight:bold;">Nguyễn Thị Huyền</span>
              <div class="form_text_warning">Nhập đúng tài khoản người giới thiệu, người giới thiệu sẽ không được thay đổi trong bất kỳ trường hợp nào.</div>
              </td>
            </tr>
             <tr>
              <td class="form_name" valign="top">Điều khoản đăng ký:</td>
              <td class="form_text">
              <textarea name="textarea"  rows="8" disabled="disabled" class="uniform" style="font-size:11px; color:#444; width:100%;">
Quy định tham gia phát triển hệ thống người tiêu dùng tại Công ty cổ phần TMDV BeRichMart Việt Nam.
Bằng việc đăng ký tham gia trở thành Thành Viên của Công ty, Bạn đồng ý chấp nhận và tuân thủ các quy định sau đây:
1. Thông tin cá nhân:
- Thành viên đồng ý cung cấp cho Công ty cổ phần TMDV BeRichMart Việt Nam các thông tin trung thực về bản thân bằng cách điền vào "Phiếu đăng ký" và "Hồ sơ". Các thông tin này sẽ giúp Công ty thực hiện tốt hơn việc quản lý hồ sơ và công tác chăm sóc khách hàng.
- BeRichMart cam kết bảo mật thông tin cá nhân của thành viên và chỉ cung cấp cho bên thứ 3 khi có sự đồng ý của thành viên.

2. Quyền lợi Thành viên:
- Thành viên được sử dụng các tiện ích của Công ty:
- Các giao dịch thanh toán trên tài khoản thanh toán BRM.
- Hưởng quyền lợi về chính sách bán hàng dành cho Thành viên :
- Hoa hồng tiêu dùng 10% khi thành viên thanh toán bằng thẻ và 5% khi thành viên thanh toán bằng tiền mặt (trừ thẳng vào đơn hàng khi mua hàng áp dụng cho tất cả các thành viên chính thức và thành viên kết nối)
- Hoa hồng giới thiệu Thành viên.
- Hoa hồng thụ động.
- Được tham gia quỹ thưởng dành cho Thành viên.
- Được chuyển đổi hoa hồng thành tiền mặt.
- Được cấp văn phòng làm việc tại website: www.BeRichMart.com.vn

3. Nghĩa vụ Thành viên:
a. Thanh toán tiền hàng đầy đủ cho Công ty.
b. Tư vấn chính xác về chính sách bán hàng và chế độ trả thưởng của Công ty.
c. Thành viên có trách nhiệm hướng dẫn, hỗ trợ Thành viên trực thuộc hệ thống Thành viên của mình.
d. Cung cấp đầy đủ, chính xác thông tin xác thực thành viên trực thuộc hệ thống Thành viên của Công ty BRM.

4. Những điều khoản cấm:
a. Nghiêm cấm tuyệt đối việc đăng ký giả mạo hoặc dùng nhiều địa chỉ chứng minh thư khác nhau để đăng ký nhiều tài khoản cho một người.
b. Thành viên sẽ không được phép sử dụng bất kỳ nhãn hiệu thương mại, tên, biểu tượng, khẩu ngữ của Công ty vào mục đích khác mà không được sự đồng ý của Công ty ngoài việc phân phối, quảng cáo như đã được Công ty đồng ý.
c. Nghiêm cấm tuyệt đối việc dùng danh nghĩa Công ty cổ phần TMDV BeRichMart Việt Nam và lợi dụng mạng lưới thành viên của Công ty vào mục đích cá nhân, để quảng bá các chương trình kinh doanh không có liên quan đến Công ty bằng e-mail hoặc trên mạng Internet.
d. Công ty cổ phần TMDV BeRichMart Việt Nam sẽ áp dụng các chế tài xử lý vi phạm đối với các trường hợp vi phạm những điều khoản nói trên. Các chế tài xử lý vi phạm có thể là cảnh cáo, phạt tiền, xóa tài khoản  vĩnh viễn khỏi danh sách thành viên hoặc tổng hợp cả 3 biện pháp trên. Việc lựa chọn biện pháp phạt phụ thuộc vào mức độ và số lần vi phạm của thành viên.  

5. Hủy bỏ tài khoản:
a. Thành viên có quyền thông báo cho Công ty cổ phần TMDV BeRichMart Việt Nam về quyết định ngừng tham gia phát triển hệ thống mạng lưới vào bất cứ lúc nào. Trường hợp này đồng nghĩa với việc Thành viên đồng ý hủy bỏ toàn bộ những quyền lợi của mình với tư cách là thành viên hệ thống tính đến thời điểm đó.
b. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền xóa tài khoản của Bạn nếu tài khoản đó không có hoạt động mua hàng trong vòng 6 tháng
c. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền xóa tên và tài khoản của Bạn nếu Bạn có những hành động đi ngược lại với quyền lợi của công ty như nêu trong mục 4 ("Những điều khoản cấm").
d. Trong trường hợp tài khoản bị xóa vì các lý do nêu trên, việc đăng ký lại tài khoản khác tại Công ty cổ phần TMDV BeRichMart Việt Nam chỉ có thể được thực hiện sau thời gian ít nhất là 6 tháng.   
e. Trong trường hợp thành viên không nâng cấp lên thành viên chính thức thì công ty có thể thay thế hoặc xóa bỏ bất cứ lúc nào.

6. Các quy định khác:
a. Khi quý khách giới thiệu cho khách hàng, quý khách tuyệt đối phải giới thiệu một cách trung thực.
b. Công ty cổ phần TMDV BeRichMart Việt Nam có quyền thay đổi điều kiện và phương thức rút tiền và thông báo đến thành viên bằng việc công bố công khai trên website hoặc gửi tin nhắn tới mã số Thành viên .
c. Công ty cổ phần TMDV BeRichMart Việt Nam có thể bổ sung, mở rộng hoặc thu hẹp các chương trình kinh doanh theo nhu cầu. Những thay đổi (nếu có) sẽ được thông báo đến các Thành viên bằng tin nhắn về mã số Thành viên hoặc công bố trên website và chỉ được áp dụng từ sau ngày công bố.  

7. Thuế (Thuế Giá Trị Gia Tăng và Thuế Thu Nhập cá nhân)
7.1. Mỗi bên tự chịu trách nhiệm đối với các nghĩa vụ thuế của mình trước cơ quan thuế của Việt Nam theo quy định của phát luật. khi được BeRichMart yêu cầu, các Thành viên sẽ phải cung cấp các bằng chứng chứng minh mình đã hoàn thành các nghĩa vụ thuế (nếu có). Theo quy định của pháp luật,  BeRichMart sẽ khấu trừ thuế thu nhập cá nhân 10% - 20% trên thu nhập hoa hồng của Thành Viên để thực hiện việc nộp thuế thay cho các thành viên.
7.2. Thành viên đồng ý rằng BeRichMart có quyền
a) Thông báo cho các cơ quan có thẩm quyền của Việt Nam mọi thông tin liên quan đến việc bán hợp tác giữa BeRichMart và Thành viên; và 
b) Nếu pháp luật quy định hoặc theo yêu cầu của các cơ quan thuế Việt Nam, BeRichMart sẽ thực hiệp việc thu các khoản thuế đến hạn áp dụng cho các hoạt động của Thành viên theo hợp đồng này và trực tiếp nộp các khoản thuế đó cho các cơ quan thuế của Việt Nam.
 

                Công ty cổ phần TMDV BeRichMart Việt Nam
                E-mail: Website: http://www. BeRichMart.com.vn
          

              </textarea>
              </td>
            </tr>
            <tr>
              <td class="form_name"><font class="form_asterisk">* </font>Mã số an toàn :</td>
              <td class="form_text"><input class="form_control" type="text" autocomplete="off" title="Mã số an toàn" id="security_code" name="security_code" value="" style="width:70px; height:px" maxlength="4">
                <img align="absmiddle" hspace="5" src="images/getcaptcha.png" alt="">&nbsp;&nbsp;<a href=""><img src="images/f5.png" alt="" align="absmiddle"/></a></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="checkbox" name="" />&nbsp;Tôi đã đọc và đồng ý với <a href="" style="color:#0073AE; text-decoration:underline;"> các quy định và điều khoản</a> của BeRichMart</td>
            </tr>
            <tr>
            	<td></td>
                <td><input type="submit" name="" value="Đăng ký thành viên"/></td>
            </tr>
          </tbody>
        </table>