create table Block (
	id serial,

	createdate timestamp not null,
	modified_date timestamp not null default LOCALTIMESTAMP(0),

	displayorder integer not null default 0,
	attachment integer null references Attachment(id) on delete set null,
	media integer null references Media(id) on delete set null,
	image integer null references Image(id) on delete set null,
	bodytext text null,

	primary key (id)
);
