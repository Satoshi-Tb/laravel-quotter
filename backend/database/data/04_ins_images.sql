insert into images (
   path,
   created_at,
   updated_at
) values ( 'profile_icon.png',
           now(),
           now() );
update qusers
   set
   profile_image_id = 1
 where id = 1;