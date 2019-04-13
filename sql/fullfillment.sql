CREATE DATABASE fullfillment
  DEFAULT CHARACTER SET utf8;
USE fullfillment;

CREATE TABLE users(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  names VARCHAR(100) NOT NULL,
  last_names VARCHAR(100) NOT NULL,
  level TINYINT NOT NULL,
  email VARCHAR(100) NOT NULL,
  status TINYINT NOT NULL,
  hash_recover_password VARCHAR(255) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE rfq(
  id INT NOT NULL UNIQUE,
  id_usuario INT NOT NULL,
  usuario_designado INT NOT NULL,
  canal VARCHAR(100) NOT NULL,
  email_code VARCHAR(100) NOT NULL,
  type_of_bid VARCHAR(100) NOT NULL,
  issue_date VARCHAR(100) NOT NULL,
  end_date VARCHAR(100) NOT NULL,
  status TINYINT NOT NULL,
  completado TINYINT NOT NULL,
  total_cost DECIMAL(10,2),
  total_price DECIMAL(10,2),
  comments VARCHAR(100),
  award TINYINT NOT NULL,
  fecha_completado DATE,
  fecha_submitted DATE,
  fecha_award DATE,
  payment_terms VARCHAR(100) NOT NULL,
  address TEXT CHARACTER SET utf8 NOT NULL,
  ship_to TEXT CHARACTER SET utf8 NOT NULL,
  expiration_date DATE NOT NULL,
  ship_via VARCHAR(100) NOT NULL,
  taxes DECIMAL(10,2) NOT NULL,
  profit DECIMAL(10,2) NOT NULL,
  additional VARCHAR(100) NOT NULL,
  shipping_cost DECIMAL(10,2) NOT NULL,
  shipping VARCHAR(100) NOT NULL,
  rfp INT NOT NULL,
  fullfillment TINYINT NOT NULL,
  contract_number VARCHAR(255) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE rfq_fullfillment_part(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  name VARCHAR(255) NOT NULL,
  business_classification VARCHAR(255) NOT NULL,
  description TEXT CHARACTER SET utf8 NOT NULL,
  po_date DATE NOT NULL,
  eta1 DATE NOT NULL,
  consolidate_others DECIMAL(20,2) NOT NULL,
  fullfillment_date DATETIME NOT NULL,
  in_process TINYINT NOT NULL,
  in_process_date DATETIME NOT NULL,
  invoice TINYINT NOT NULL,
  invoice_date DATETIME NOT NULL,
  eta2 DATE NOT NULL,
  eta3 DATE NOT NULL,
  comment_consolidate_others VARCHAR(255) NOT NULL,
  due_date DATE NOT NULL,
  accounting_ship_to VARCHAR(255) NOT NULL,
  accounting_completed TINYINT NOT NULL,
  accounting_completed_date DATETIME NOT NULL,
  order_date DATE NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE work_orders(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  responsible VARCHAR(255) NOT NULL,
  company VARCHAR(255) NOT NULL,
  address TEXT CHARACTER SET utf8 NOT NULL,
  phone VARCHAR(255) NOT NULL,
  client TEXT CHARACTER SET utf8 NOT NULL,
  date DATE NOT NULL,
  bpa VARCHAR(255) NOT NULL,
  doc_name VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE work_order_items(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_work_order INT NOT NULL,
  equipment TEXT CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_work_order)
    REFERENCES work_orders(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE work_order_item_details(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_work_order_item INT NOT NULL,
  detail_name VARCHAR(255) NOT NULL,
  detail VARCHAR(255) NOT NULL,
  keycode VARCHAR(255) NOT NULL,
  notes VARCHAR(255) NOT NULL,
  technitian VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_work_order_item)
    REFERENCES work_order_items(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE purchase_orders(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  responsible VARCHAR(255) NOT NULL,
  date DATE NOT NULL,
  purchase_from TEXT CHARACTER SET utf8 NOT NULL,
  drop_ship_to TEXT CHARACTER SET utf8 NOT NULL,
  comments TEXT CHARACTER SET utf8 NOT NULL,
  ref_quote VARCHAR(255) NOT NULL,
  ship_via VARCHAR(255) NOT NULL,
  order_date DATE NOT NULL,
  terms VARCHAR(255) NOT NULL,
  subtotal DECIMAL(20,2) NOT NULL,
  shipment_cost DECIMAL(20,2) NOT NULL,
  total DECIMAL(20,2) NOT NULL,
  message TEXT CHARACTER SET utf8 NOT NULL,
  taxes DECIMAL(20,2) NOT NULL,
  doc_name VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE purchase_order_items(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_purchase_order INT NOT NULL,
  part_number VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  description TEXT CHARACTER SET utf8 NOT NULL,
  unit_price DECIMAL(20,2) NOT NULL,
  amount DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_purchase_order)
    REFERENCES purchase_orders(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE comments_rfq(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  nombre_usuario VARCHAR(255) NOT NULL,
  comment TEXT CHARACTER SET utf8 NOT NULL,
  fecha_comment DATETIME,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE item(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  id_usuario INT NOT NULL,
  provider_menor INT NOT NULL,
  brand VARCHAR(100) NOT NULL,
  brand_project VARCHAR(100) NOT NULL,
  part_number VARCHAR(100) NOT NULL,
  part_number_project VARCHAR(100) NOT NULL,
  description TEXT CHARACTER SET utf8 NOT NULL,
  description_project TEXT CHARACTER SET utf8 NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  comments TEXT CHARACTER SET utf8 NOT NULL,
  website VARCHAR(255) NOT NULL,
  additional VARCHAR(100) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE extra_item(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_item INT NOT NULL,
  payment_terms TEXT CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE trackings(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_item INT NOT NULL,
  quantity INT NOT NULL,
  tracking_number TEXT CHARACTER SET utf8 NOT NULL,
  delivery_date DATE NOT NULL,
  signed_by VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE provider(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_item INT NOT NULL,
  provider VARCHAR(100) NOT NULL,
  price  DECIMAL(10,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE subitems(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_item INT NOT NULL,
  provider_menor INT NOT NULL,
  brand VARCHAR(100) NOT NULL,
  brand_project VARCHAR(100) NOT NULL,
  part_number VARCHAR(100) NOT NULL,
  part_number_project VARCHAR(100) NOT NULL,
  description TEXT CHARACTER SET utf8 NOT NULL,
  description_project TEXT CHARACTER SET utf8 NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  total_price DECIMAL(10,2) NOT NULL,
  comments TEXT CHARACTER SET utf8 NOT NULL,
  website VARCHAR(255) NOT NULL,
  additional VARCHAR(100) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE extra_subitem(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_subitem INT NOT NULL,
  payment_terms TEXT CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_subitem)
    REFERENCES subitems(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE trackings_subitems(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_subitem INT NOT NULL,
  quantity INT NOT NULL,
  tracking_number TEXT CHARACTER SET utf8 NOT NULL,
  delivery_date DATE NOT NULL,
  signed_by VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_subitem)
    REFERENCES subitems(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE provider_subitems(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_subitem INT NOT NULL,
  provider VARCHAR(255) NOT NULL,
  price  DECIMAL(10,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_subitem)
    REFERENCES subitems(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE packing_slips(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  responsible VARCHAR(255) NOT NULL,
  order_date DATE NOT NULL,
  customer_contact TEXT CHARACTER SET utf8 NOT NULL,
  ship_to TEXT CHARACTER SET utf8 NOT NULL,
  message TEXT CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE packing_slip_items(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_packing_slip INT NOT NULL,
  id_item INT NOT NULL,
  unit_type VARCHAR(255) NOT NULL,
  back_order_quantity INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_packing_slip)
    REFERENCES packing_slips(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE packing_slip_subitems(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_packing_slip_item INT NOT NULL,
  id_subitem INT NOT NULL,
  unit_type VARCHAR(255) NOT NULL,
  back_order_quantity INT NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_packing_slip_item)
    REFERENCES packing_slip_items(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT,
  FOREIGN KEY(id_subitem)
    REFERENCES subitems(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE ship_to(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  ship_to VARCHAR(255) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE accounting_item_price(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_item INT NOT NULL,
  company VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  unit_cost DECIMAL(20,2) NOT NULL,
  other_cost DECIMAL(20,2) NOT NULL,
  real_cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_item)
    REFERENCES item(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE accounting_subitem_price(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_subitem INT NOT NULL,
  company VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  unit_cost DECIMAL(20,2) NOT NULL,
  other_cost DECIMAL(20,2) NOT NULL,
  real_cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_subitem)
    REFERENCES subitems(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE extra_costs(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_rfq INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_rfq)
    REFERENCES rfq(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE fulfillment_projects(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_project INT NOT NULL,
  received TINYINT NOT NULL,
  received_date DATETIME NOT NULL,
  name VARCHAR(255) NOT NULL,
  business_classification VARCHAR(255) NOT NULL,
  due_date DATE NOT NULL,
  ship_to VARCHAR(255) NOT NULL,
  accounting_completed TINYINT NOT NULL,
  accounting_completed_date DATETIME NOT NULL,
  order_date DATE NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE project_comments(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  username VARCHAR(255) NOT NULL,
  comment TEXT CHARACTER SET utf8 NOT NULL,
  comment_date DATETIME NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE project_documents(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  documents_name TEXT CHARACTER SET utf8 NOT NULL,
  comment TEXT CHARACTER SET utf8 NOT NULL,
  document_date DATETIME NOT NULL,
  username VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE real_project_costs(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE members(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  names VARCHAR(255) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE project_dates(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  date DATE NOT NULL,
  comment TEXT CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);

CREATE TABLE accounting_services_price(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_service INT NOT NULL,
  id_fulfillment_project INT NOT NULL,
  company VARCHAR(255) NOT NULL,
  quantity INT NOT NULL,
  unit_cost DECIMAL(20,2) NOT NULL,
  other_cost DECIMAL(20,2) NOT NULL,
  real_cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id)
);

CREATE TABLE extra_services(
  id INT NOT NULL AUTO_INCREMENT UNIQUE,
  id_fulfillment_project INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  cost DECIMAL(20,2) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(id_fulfillment_project)
    REFERENCES fulfillment_projects(id)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
);
