CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_participants_save`(
ppname VARCHAR(150), 
pcpf VARCHAR(20), 
pphone BIGINT,
pemail VARCHAR(40),
plogin VARCHAR(64),   
ppassword VARCHAR(256),
pevent_id INT(11),
pcategory VARCHAR(50),
pidevent INT(11)
)
BEGIN
 
   
    
 INSERT INTO tb_participants (pname, cpf, phone,
		 email, login, password, event_id, category) 
    VALUES(ppname, pcpf, pphone, pemail, plogin, ppassword, pevent_id, pcategory);
    
    
    UPDATE tb_event SET subscribes = subscribes + 1 WHERE idevent = pidevent;
    
END