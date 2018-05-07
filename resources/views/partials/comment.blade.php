	<div class="container-fluid">
       			<div class="panel panel-default widget">
            		<div class="panel-heading">
                		<span class="glyphicon glyphicon-comment"></span>
                		<h3 class="panel-title">Comments</h3>
                		<span class="label label-info">Number of comment: {{ count($comments) }}</span>
            		</div>
            		<div class="panel-body">
               			<ul class="list-group">
                		@foreach($comments as $comment)
                   			<li class="list-group-item">
                        		<div class="row">
                            		<div class="col-xs-10 col-md-11">
                            			<div class="comment-text"><a href="/users/{{ $comment->user->id}}">{{ $comment->user->first_name }} - {{ $comment->user->last_name }} </a></div>
                            			<p>Commented on {{ $comment->user->created_at }} </p>
                            			<a>{{ $comment->url }} </a>
                                		<div class="comment-text">{{ $comment->body }}</div>
                                		<div class="action">
                                    		<button type="button" class="btn btn-primary btn-xs" title="Edit">
                                        		<span class="glyphicon glyphicon-pencil"></span>
                                    		</button>
                                    		<button type="button" class="btn btn-success btn-xs" title="Approved">
                                        		<span class="glyphicon glyphicon-ok"></span>
                                    		</button>
                                    		<button type="button" class="btn btn-danger btn-xs" title="Delete">
                                        		<span class="glyphicon glyphicon-trash"></span>
                                    		</button>
                                		</div>
                           			</div>
                        		</div>
                    		</li>
                    	@endforeach
                  		</ul>
            		</div>
        		</div>
    		</div>