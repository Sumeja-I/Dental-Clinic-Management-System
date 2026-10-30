create view appointment_search as
select a.aid as id, a.appointment_start as app,
       date(a.appointment_start) as dateapp, concat(p.first_name, ' ', p.last_name) as fname,
       p.email, concat(d.first_name, ' ', d.last_name) as dentist, a.appointment_status as status, t_name, t_duration, a.app_total_price as price
from appointment a
join  dentist d on a.dentist = d.did
join people p on a.people = p.pid
join treatment t on a.treatment = t.tid;
