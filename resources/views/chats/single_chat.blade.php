<div class="card direct-chat direct-chat-primary card-dark-moon card-outline">
    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">Chat History</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" style="overflow-y: scroll !important; height:350px !important;">
        <!-- Message. Default to the left -->
            <div class="infinite-scroll">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">name</span>
                    <span class="direct-chat-timestamp float-right"></span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="/teacher_images/" alt="teacher user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        {{$comment->message}}
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
                
                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                    <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">name</span>
                        <span class="direct-chat-timestamp float-left">time</span>
                    </div>
                    <!-- /.direct-chat-infos -->
                    <img class="direct-chat-img" src="/student_images/{{$comment->user->student->image}}" alt="student user image">
                    <!-- /.direct-chat-img -->
                    <div class="direct-chat-text">
                        text
                    </div>
                    <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
            </div>
        </div>
        <!--/.direct-chat-messages-->
        <!-- Contacts are loaded here -->
        <!-- /.direct-chat-pane -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="input-group">
            <textarea id="example1" name="chat" class="form-control form-control-border border-width-2" rows="3" placeholder="Type Message ..."></textarea>
        </div>
        <button type="submit" class="btn btn-light-green float-right mt-1">Send</button>
    </div>
    <!-- /.card-footer-->
</div>