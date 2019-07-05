insert ignore into alevel_popular_products (`sku`, `product_id`, `name`, `small_image`, `final_price`)
select
	p.sku as sku, p.entity_id as product_id, pv.value as name, pv2.value as small_image, pv3.value as final_price
	from catalog_product_entity as p
inner join catalog_product_entity_varchar as pv on pv.entity_id = p.entity_id
inner join catalog_product_entity_varchar as pv2 on pv2.entity_id = p.entity_id
inner join catalog_product_entity_decimal as pv3 on pv3.entity_id = p.entity_id
right join catalog_product_entity_int as pv4 on pv4.entity_id = p.entity_id
inner join eav_attribute as ea on ea.`attribute_id`= pv.`attribute_id`
inner join eav_attribute as ea2 on ea2.`attribute_id`= pv2.`attribute_id`
inner join eav_attribute as ea3 on ea3.`attribute_id`= pv3.`attribute_id`
right join eav_attribute as ea4 on ea4.`attribute_id`= pv4.`attribute_id`

where
	ea.`attribute_code` = 'name'
	and ea2.attribute_code='small_image'
	and ea3.attribute_code='price'
	and ea4.attribute_code='is_popular'
	and pv4.value = 1;