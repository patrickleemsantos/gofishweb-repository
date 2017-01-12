
  <div class="modal fade" id="user" data-backdrop="false">
    <div class="right w-xl bg-white md-whiteframe-z2">
        <div class="box">
    <div class="p p-h-md">
      <a data-dismiss="modal" class="pull-right text-muted-lt text-2x m-t-n inline p-sm">&times;</a>
      <strong>Chat</strong>
    </div>
    <div class="box-row">
      <div class="box-cell">
        <div class="box-inner">
          <div id="div_chat_list" class="list-group no-radius no-borders">
            <!-- <a data-toggle="modal" data-target="#chat" data-dismiss="modal"  class="list-group-item p-h-md">
              <img src="images/a1.jpg" class="pull-left w-40 m-r img-circle">
              <div class="clear">
                <span class="font-bold block">Jonathan Doe</span>
                <span class="clear text-ellipsis text-xs">"Hey, What's up"</span>
              </div>
            </a> -->
          </div>
        </div>
      </div>
    </div>
  </div>

    </div>
  </div>

  <div class="modal fade" id="chat" data-backdrop="false">
    <div class="right w-xxl bg-white md-whiteframe-z2">
        <div class="box">
    <div class="p p-h-md">
      <a id="btn-close-chat" data-dismiss="modal" class="pull-right text-muted-lt text-2x m-t-n inline p-sm">&times;</a>
      <strong>Chat</strong>
    </div>
    <div class="box-row bg-light lt">
      <div id="div_chat" class="box-cell">
        <div id="message" class="box-inner">
          <div class="p-md" id="messages">

          </div>
        </div>
      </div>
    </div>
    <div class="p-h-md p-v">
      <!-- <a class="pull-left w-32 m-r"><img src="images/a3.jpg" class="w-full img-circle" alt="..."></a> -->
      <form>
        <div class="input-group">
          <input id="txt-message" type="text" class="form-control" placeholder="Say something">
          <span class="input-group-btn">
            <button id="btn_send_message" class="btn btn-default" type="button">SEND</button>
          </span>
        </div>
      </form>
    </div>
  </div>

    </div>
  </div>
</div>
</body>
</html>