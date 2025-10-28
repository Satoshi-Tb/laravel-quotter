insert into messages (
   chat_id,
   mentioned_user_id,
   content,
   created_at,
   updated_at
) values ( 1,
           1,
           'I am user1.',
           now(),
           now() );
insert into messages (
   chat_id,
   mentioned_user_id,
   content,
   created_at,
   updated_at
) values ( 1,
           2,
           'I am user2.',
           now(),
           now() );