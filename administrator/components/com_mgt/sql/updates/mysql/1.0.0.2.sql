create or replace view `#__mgt` as
select `o`.`dat`,
       if(length(`v`.`num_park`) < 6 and `v`.`srv_id` < 100, concat('0', `v`.`num_park`),
          `v`.`num_park`)                                      AS `num_park`,
       if(`v`.`srv_id` < 100, 0, if(`v`.`srv_id` < 199, 1, 2)) AS `type`,
       `o`.`route`                                             AS `route`,
       (`v`.`last_sync` + interval 3 hour)                     AS `last_sync`
from `#__mgt_online` as `o`
       left join `#__mgt_vehicles` as `v` on `v`.`id` = `o`.`vehicle_id`;

alter table `#__mgt_online`
  add tm time default null null comment 'Время фиксации';

create or replace view `#__mgt` as
select `o`.`dat`,
       if(length(`v`.`num_park`) < 6 and `v`.`srv_id` != 8 and `v`.`srv_id` < 100, concat('0', `v`.`num_park`),
          `v`.`num_park`)                                      AS `num_park`,
       if(`v`.`srv_id` < 100, 0, if(`v`.`srv_id` < 199, 1, 2)) AS `type`,
       `o`.`route`                                             AS `route`,
       (`v`.`last_sync` + interval 3 hour)                     AS `last_sync`,
       (IF(`o`.`tm` is null, '', `o`.`tm` + interval 3 hour))  AS `tm`
from `#__mgt_online` as `o`
       left join `#__mgt_vehicles` as `v` on `v`.`id` = `o`.`vehicle_id`;

alter table `#__mgt_vehicles modify` srv_id int (4) not null comment 'ID Сервера';

create or replace view `#__mgt` as
select `o`.`dat`,
       if(length(`v`.`num_park`) < 6 and `v`.`srv_id` < 100, concat('0', `v`.`num_park`),
          `v`.`num_park`)                                      AS `num_park`,
       `o`.`vehicle_id`,
       if(`v`.`srv_id` < 100, 0, if(`v`.`srv_id` < 199, 1, 2)) AS `type`,
       `o`.`route`                                             AS `route`,
       (`v`.`last_sync` + interval 3 hour)                     AS `last_sync`,
       (IF(`o`.`tm` is null, '', `o`.`tm` + interval 3 hour))  AS `tm`
from `#__mgt_online` as `o`
       left join `#__mgt_vehicles` as `v` on `v`.`id` = `o`.`vehicle_id`;



