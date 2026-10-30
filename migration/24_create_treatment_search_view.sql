CREATE VIEW vtreatment_details AS
SELECT
    t.tid AS tid,
    t.t_name AS tName,
    t.t_duration AS tDuration,
    t.price AS tPrice,
    LOWER(t.t_status) AS tStatus,
    c.c_name AS cName
FROM treatment t
         JOIN category c ON t.category = c.cid;