<script type="text/javascript">
  function gotoSecondForm() {
    var errors = [];
    var errorMessage=`<img src="./Cybercrime-Report/exclamation-octagon.png"> This field is required.
    <div class="form-error-arrow">
      <div class="form-error-arrow-inner"></div>
    </div>`;
      for (var i = 1; i <= 3; i++) {
        var inputValue=$(`#input_${i}`).val();
        if (inputValue==="") {
          $(`#id_${i}`).addClass('form-line-error');
          $(`#message_${i}`).html(errorMessage);
          $(`#message_${i}`).show();
          $(`#description_${i}`).show();
          errors[i] = i;
        }else {
          $(`#id_${i}`).removeClass('form-line-error');
          $(`#message_${i}`).hide();
          $(`#description_${i}`).hide();
          if (errors.indexOf(i)) {
            errors.splice(i,i);
          }
        }
      }

      var firstnameValue=$(`#first_2`).val();
      var lastnameValue=$(`#last_2`).val();
        if (firstnameValue==="") {
          $(`#id_2`).addClass('form-line-error');
          $(`#firstmessage`).html(errorMessage);
          $(`#firstmessage`).show();
          $(`#description_2`).show();
          errors[2] = 2;
        }else {
          $(`#id_2`).removeClass('form-line-error');
          $(`#firstmessage`).hide();
          $(`#description_2`).hide();
          if (errors.indexOf(i)) {
            errors.splice(2,2);
          }
        }
        if (lastnameValue==="") {
          $(`#id_2`).addClass('form-line-error');
          $(`#lastmessage`).html(errorMessage);
          $(`#lastmessage`).show();
          $(`#description_2`).show();
          errors[4] = 4;
        }else {
          $(`#id_2`).removeClass('form-line-error');
          $(`#lastmessage`).hide();
          $(`#description_2`).hide();
          if (errors.indexOf(i)) {
            errors.splice(4,4);
          }
        }
        var passwordValue=$(`#password`).val();
        var comfirmValue=$(`#ComfirmPassword`).val();
        if (passwordValue==="" || passwordValue.length < 8 ) {
          $(`#id_4`).addClass('form-line-error');
          $(`#passwordmessage`).html(`<img src="./Cybercrime-Report/exclamation-octagon.png">
           Please your password must be up to 8 characters.
          <div class="form-error-arrow">
            <div class="form-error-arrow-inner"></div>
          </div>`);
          $(`#passwordmessage`).show();
          $(`#passwordDescription`).show();
          errors[5] = 5;
        }else {
          $(`#id_4`).removeClass('form-line-error');
          $(`#passwordmessage`).hide();
          $(`#passwordDescription`).hide();
          if (errors.indexOf(i)) {
            errors.splice(5,5);
          }
        }
        if (comfirmValue==="" || passwordValue!==comfirmValue) {
          $(`#id_4`).addClass('form-line-error');
          $(`#ComfirmPasswordMessage`).html(`<img src="./Cybercrime-Report/exclamation-octagon.png">
           Password does not match.
          <div class="form-error-arrow">
            <div class="form-error-arrow-inner"></div>
          </div>`);
          $(`#ComfirmPasswordMessage`).show();
          $(`#passwordDescription`).show();
          errors[6] = 6;
        }else {
          $(`#id_4`).removeClass('form-line-error');
          $(`#ComfirmPasswordMessage`).hide();
          $(`#ComfirmPasswordMessage`).hide();
          if (errors.indexOf(i)) {
            errors.splice(6,6);
          }
        }
      if (errors.length === 0) {
        $("#1st-form").hide();
        $("#2nd-form").show();
      }else {
        console.log(errors);
      }
  }
</script>
<ul class="form-section page-section" id="1st-form">
  <li id="cid_1" class="form-input-wide" data-type="control_head">
    <div class="form-header-group  header-default">
      <div class="header-text  ">
        <h2 id="header_1" class="form-header" data-component="header">
          Cybercrime Report
        </h2>
        <input type="hidden" name="register" value="register">
        <div id="subHeader_1" class="form-subHeader">
          To report an incident, please provide the following information
        </div>
      </div>
    </div>
  </li>
  <li class="form-line jf-required " data-type="control_dropdown" id="id_1" style="z-index: 0;">
    <label class="form-label form-label-left form-label-auto" id="label_1" for="input_1">
      Type of report
      <span class="form-required">
        *
      </span>
    </label>
    <div id="cid_1" class="form-input jf-required">
      <select class="form-dropdown validate[required] form-validation-error" id="input_1" name="report-type" style="width:150px" data-component="dropdown" required="" aria-labelledby="label_2">
        <option value="">  </option>
        <?php require 'forms/report-type.php'; ?>
      </select>
      <div class="form-error-message" id="message_1"  style="display: none;"></div>
    </div>
    <div class="form-description" id="description_1" style="display: none;">
      <div class="form-description-arrow"></div>
      <div class="form-description-arrow-small"></div>
      <div class="form-description-content">State the nature of the victim</div>
    </div>
</li>
  <li class="form-line" data-type="control_fullname" id="id_2">
    <label class="form-label form-label-left form-label-auto" id="label_2" for="first_2"> Incident reported by<span class="form-required">*</span> </label>

    <div id="cid_2" class="form-input">
      <div data-wrapper-react="true">
        <span class="form-sub-label-container" style="vertical-align:top" data-input-type="first">
          <input type="text" id="first_2" name="firstname" class="form-textbox" size="10" value="" data-component="first" aria-labelledby="label_2 sublabel_2_first">
          <label class="form-sub-label" for="first_2" id="sublabel_2_first" style="min-height:13px" aria-hidden="false"> First Name </label>
          <div class="form-error-message" id="firstmessage"  style="display: none;"></div>
        </span>
        <span class="form-sub-label-container" style="vertical-align:top" data-input-type="last">
          <input type="text" id="last_2" name="lastname" class="form-textbox" size="15" value="" data-component="last" aria-labelledby="label_2 sublabel_2_last">
          <label class="form-sub-label" for="last_2" id="sublabel_2_last" style="min-height:13px" aria-hidden="false"> Last Name </label>
          <div class="form-error-message" id="lastmessage"  style="display: none;"></div>
        </span>
      </div>
      <div class="form-description" id="description_2" style="display: none;">
        <div class="form-description-arrow"></div>
        <div class="form-description-arrow-small"></div>
        <div class="form-description-content">State your firstname and lastname</div>
      </div>
    </div>
  </li>

  <li class="form-line" data-type="control_email" id="id_3">
    <label class="form-label form-label-left form-label-auto" id="label_3" for="input_3"> Email address </label>
    <div id="cid_3" class="form-input">
      <input type="email" id="input_3" name="email" class="form-textbox validate[Email]" size="30" value="" placeholder="ex: myname@example.com" data-component="email" aria-labelledby="label_3">
      <div class="form-error-message" id="message_3"  style="display: none;">

      </div>
    </div>
    <div class="form-description" id="description_3" style="display: none;">
      <div class="form-description-arrow"></div>
      <div class="form-description-arrow-small"></div>
      <div class="form-description-content">Type in your E-mail address</div>
    </div>
  </li>
  <li class="form-line jf-required " data-type="control_dropdown" id="id_119" style="z-index: 0;">
    <label class="form-label form-label-left form-label-auto" id="label_119" for="input_119">
      Gender
      <span class="form-required">
        *
      </span>
    </label>
    <div id="cid_119" class="form-input jf-required">
    <input type="radio" name="gender" value="male" checked> Male<br>
    <input type="radio" name="gender" value="female"> Female<br>
      <div class="form-error-message" id="message_119"  style="display: none;"></div>
    </div>
    <div class="form-description" id="description_119" style="display: none;">
      <div class="form-description-arrow"></div>
      <div class="form-description-arrow-small"></div>
      <div class="form-description-content">State your gender</div>
    </div>
</li>

<li class="form-line jf-required " data-type="control_dropdown" id="id_55" style="z-index: 0;">
    <label class="form-label form-label-left form-label-auto" id="label_1" for="input_1">
    Occupation
      <span class="form-required">
        *
      </span>
    </label>
    <div id="cid_55" class="form-input jf-required">
    <input type="text" id="occupation" name="occupation" class="form-textbox" size="10" value="" data-component="occupation" aria-labelledby="occupation occupationLabel">
          <label class="form-sub-label" for="occupation" id="occupationLabel" style="min-height:13px" aria-hidden="false"> occupation </label>
      <div class="form-error-message" id="message_55"  style="display: none;"></div>
    </div>
    <div class="form-description" id="description_55" style="display: none;">
      <div class="form-description-arrow"></div>
      <div class="form-description-arrow-small"></div>
      <div class="form-description-content">State your occupation</div>
    </div>
</li>
  <li class="form-line" data-type="control_fullname" id="id_4">
    <label class="form-label form-label-left form-label-auto" id="label_4" for="first_4"> Password<span class="form-required">*</span> </label>

    <div id="cid_4" class="form-input">
      <div data-wrapper-react="true">
        <span class="form-sub-label-container" style="vertical-align:top" data-input-type="first">
          <input type="password" id="password" name="password" class="form-textbox" size="10" value="" data-component="password" aria-labelledby="password passwordLabel">
          <label class="form-sub-label" for="password" id="passwordLabel" style="min-height:13px" aria-hidden="false"> Password </label>
          <div class="form-error-message" id="passwordmessage"  style="display: none;"></div>
        </span>
        <span class="form-sub-label-container" style="vertical-align:top" data-input-type="last">
          <input type="password" id="ComfirmPassword" name="ComfirmPassword" class="form-textbox" size="15" value="" data-component="last" aria-labelledby="label_2 sublabel_2_last">
          <label class="form-sub-label" for="ComfirmPassword" id="ComfirmPasswordLabel" style="min-height:13px" aria-hidden="false"> Comfirm Password </label>
          <div class="form-error-message" id="ComfirmPasswordMessage"  style="display: none;"></div>
        </span>
      </div>
      <div class="form-description" id="passwordDescription" style="display: none;">
        <div class="form-description-arrow"></div>
        <div class="form-description-arrow-small"></div>
        <div class="form-description-content">Choose your Password</div>
      </div>
    </div>
  </li>
  <li class="form-line" data-type="control_widget" id="id_37">
    <div id="cid_37" class="">
      <div style="width:100%;text-align:Left" data-component="widget-directEmbed">
        <div class="direct-embed-widgets mobile-responsive-widget " data-type="direct-embed" style="width:1px;min-height:1px">
        </div>
      </div>
    </div>
  </li>
  <li id="cid_28" class="form-input-wide" data-type="control_pagebreak">
    <div class="form-pagebreak" data-component="pagebreak">
      <div class="form-pagebreak-back-container" style="width: 136px;">

      </div>
      <div class="form-pagebreak-next-container">
        <button id="form-pagebreak-next_28" type="button" onclick="gotoSecondForm()" class="form-pagebreak-next  jf-form-buttons" data-component="pagebreak-next">
          Next
        </button>
      </div>
      <div style="clear:both" class="pageInfo form-sub-label" id="pageInfo_28">
      </div>
    <div class="form-button-error1" style="display:none;">There are errors on this page. Please fix them before continuing.</div></div>
  </li>
</ul>
