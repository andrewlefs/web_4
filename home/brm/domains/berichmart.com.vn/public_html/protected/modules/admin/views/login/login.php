<div id="login-main">
                <!--
		<div class="notification"><div class="information png_bg"><p>Nhập chính xác thông tin và click vào Đăng nhập</p></div></div>
		<div class="notification"><div class="exclamation png_bg"><p>Nhập chính xác thông tin và click vào Đăng nhập</p></div></div>
                -->
                <form id="frm-login" name="frmlogin" method="post">
          <table width="450" border="0" cellspacing="0" cellpadding="0" class="table-login">
            <tr>
              <td width="150" align="left" valign="top"><label class="label" for="username">Tên đăng nhập</label></td>
              <td colspan="2" align="left" valign="top"><label><input type="text" name="username" id="username" class="text-input"/></label></td>
            </tr>
            <tr>
              <td align="left" valign="top"><label class="label" for="password">Mật khẩu</label></td>
              <td colspan="2" align="left" valign="top"><label><input type="password" name="password" id="password" class="text-input"/></label></td>
            </tr>
            <!--
            <tr>
              <td align="left" valign="top"><label class="label" for="captcha">Mã xác nhận</label></td>
                                    
              <td colspan="2" align="left" valign="top">
                  <label><input type="text" name="captcha" id="captcha" class="text-input"/></label>
                  
                 <?php $this->widget('CCaptcha', array(
                      'buttonLabel'=>'<br/>Tao captcha mới',
                      'clickableImage'=>true,                      
                      'imageOptions'=>array('id'=>'captchaimg')
                      ));?> 
              
              </td>
            </tr>
            -->
            <tr>
              <td align="left" valign="top"><label class="label" for="btn-login" style="display:none;">Thao tác</label></td>
              <td width="153" align="left" valign="top"><a href="#" class="lost-password">Quên mật khẩu</a></td>
              <td width="147" align="right" valign="top"><label><input type="submit" name="submit" value="Đăng nhập" id="btn-login"/></label></td>
            </tr>
          </table>		
		</form>
	</div>