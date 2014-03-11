create table Block (
	id serial,

	createdate timestamp not null,

	displayorder integer not null default 0,
	attachment integer null references Attachment(id),
	media integer null references Media(id),
	image integer null references Image(id),
	bodytext text null,

	primary key (id)
);
