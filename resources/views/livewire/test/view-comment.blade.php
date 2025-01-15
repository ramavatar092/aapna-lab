<div>
    <!-- Modal -->
    <div class="modal fade" id="ViewCommentModal" tabindex="-1" aria-labelledby="tableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tableModalLabel">Table Inside Modal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Test</th>
                                <th>comment</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($comments as $key=>$comment )
                           <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$comment->test->title}}</td>
                                <td>{{$comment->comment}}</td>
                             
                            </tr>
                           
                           @endforeach
                          
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>