create table <table> (
	id int(11) primary key not null,
	created datetime null,
    created_by  int(11) null,
    modified datetime null,
    modified_by int(11),
    deleted datetime null,
    deleted_by int(11)
);