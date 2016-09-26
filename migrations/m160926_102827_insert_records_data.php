<?php

use yii\db\Migration;

class m160926_102827_insert_records_data extends Migration
{
    public function up()
    {

//        INSERT INTO `record` (`id_record`, `author`, `date`, `text`) VALUES
//    (1, 'Петя', '2016-09-14 21:15:51', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut beatae commodi cum, dolore earum enim esse ex illo illum in laborum libero maxime molestiae natus nihil placeat porro quo repellat sed sequi tempora vel veritatis vero voluptatem. Accusamus debitis ducimus eaque excepturi in iusto minus neque quam repellendus sunt. Alias consectetur consequatur delectus dolores eaque earum excepturi explicabo id, itaque molestias officia officiis quae quod sit voluptas. Ab aperiam atque nemo nihil odio quibusdam sint vero vitae! Accusantium cupiditate dolores doloribus ipsum iste, maiores maxime minima minus neque perferendis perspiciatis quaerat qui reprehenderit sunt, suscipit velit voluptatum.'),
//(2, 'Вася', '2016-09-14 16:11:45', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut beatae commodi cum, dolore earum enim esse ex illo illum in laborum libero maxime molestiae natus nihil placeat porro quo repellat sed sequi tempora vel veritatis vero voluptatem. Accusamus debitis ducimus eaque excepturi in iusto minus neque quam repellendus sunt. Alias consectetur consequatur delectus dolores eaque earum excepturi explicabo id, itaque molestias officia officiis quae quod sit voluptas. Ab aperiam atque nemo nihil odio quibusdam sint vero vitae! Accusantium cupiditate dolores doloribus ipsum iste, maiores maxime minima minus neque perferendis perspiciatis quaerat qui reprehenderit sunt, suscipit velit voluptatum.'),
//(3, 'Коля', '2016-09-06 04:47:19', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur ipsam officia perspiciatis reprehenderit similique temporibus totam ullam voluptas. Accusantium adipisci animi architecto aut beatae deleniti dolores eligendi et, eum eveniet ex excepturi exercitationem illum incidunt minima minus neque nesciunt nihil, odio, omnis porro possimus quasi quibusdam quo quod quos recusandae sit soluta suscipit tenetur! Alias animi consequatur cupiditate eaque facere laboriosam laudantium, mollitia necessitatibus nemo nesciunt odit optio pariatur quibusdam rem rerum temporibus velit voluptatem? Debitis delectus ducimus facere iusto laboriosam molestiae porro quas quasi voluptatibus? Amet, asperiores delectus deserunt eaque earum explicabo ipsam nesciunt numquam placeat porro unde vitae.'),
//(4, 'Настя', '2016-09-09 11:31:19', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate deleniti distinctio doloremque esse hic, laborum minus modi molestiae omnis pariatur quam, qui quidem quos, sapiente sed sit veritatis? Assumenda enim fugit libero maiores obcaecati ratione. Ab adipisci asperiores cumque dolor dolore eaque eius eligendi enim error esse excepturi exercitationem, expedita fugiat id illum, maiores modi nam, natus pariatur recusandae sapiente vel velit voluptatem. Alias aspernatur deserunt, dolorem eligendi, hic iusto magni nesciunt obcaecati, odio quos repellendus saepe velit vero. Aliquid animi aperiam aspernatur assumenda at atque beatae cum delectus, dolores, ipsam itaque labore molestias neque, nostrum quibusdam quis reiciendis similique sunt unde voluptatibus? Accusantium adipisci asperiores atque culpa delectus deserunt dolor ducimus ea eius eum excepturi facere facilis hic id, nam neque officia, placeat quisquam quod repellat sapiente soluta sunt unde vel voluptate? Ad aperiam commodi culpa deserunt dicta distinctio ea eaque itaque iusto maxime molestiae neque nisi odio, optio perspiciatis porro quae quia quidem rem repellat suscipit, unde, vel vero? Deleniti ducimus excepturi explicabo incidunt ipsa ipsam magnam minus nemo nisi odit quae qui quidem recusandae, sed sint ut veniam vero! Dolores doloribus, eos excepturi harum itaque minima non odio provident ullam vel! Fuga incidunt mollitia obcaecati possimus!'),
//(5, 'Антон', '2016-08-15 01:38:09', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate deleniti distinctio doloremque esse hic, laborum minus modi molestiae omnis pariatur quam, qui quidem quos, sapiente sed sit veritatis? Assumenda enim fugit libero maiores obcaecati ratione. Ab adipisci asperiores cumque dolor dolore eaque eius eligendi enim error esse excepturi exercitationem, expedita fugiat id illum, maiores modi nam, natus pariatur recusandae sapiente vel velit voluptatem. Alias aspernatur deserunt, dolorem eligendi, hic iusto magni nesciunt obcaecati, odio quos repellendus saepe velit vero. Aliquid animi aperiam aspernatur assumenda at atque beatae cum delectus, dolores, ipsam itaque labore molestias neque, nostrum quibusdam quis reiciendis similique sunt unde voluptatibus? Accusantium adipisci asperiores atque culpa delectus deserunt dolor ducimus ea eius eum excepturi facere facilis hic id, nam neque officia, placeat quisquam quod repellat sapiente soluta sunt unde vel voluptate? Ad aperiam commodi culpa deserunt dicta distinctio ea eaque itaque iusto maxime molestiae neque nisi odio, optio perspiciatis porro quae quia quidem rem repellat suscipit, unde, vel vero? Deleniti ducimus excepturi explicabo incidunt ipsa ipsam magnam minus nemo nisi odit quae qui quidem recusandae, sed sint ut veniam vero! Dolores doloribus, eos excepturi harum itaque minima non odio provident ullam vel! Fuga incidunt mollitia obcaecati possimus!'),
//(6, 'Олег', '2016-05-27 20:05:34', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate deleniti distinctio doloremque esse hic, laborum minus modi molestiae omnis pariatur quam, qui quidem quos, sapiente sed sit veritatis? Assumenda enim fugit libero maiores obcaecati ratione. Ab adipisci asperiores cumque dolor dolore eaque eius eligendi enim error esse excepturi exercitationem, expedita fugiat id illum, maiores modi nam, natus pariatur recusandae sapiente vel velit voluptatem. Alias aspernatur deserunt, dolorem eligendi, hic iusto magni nesciunt obcaecati, odio quos repellendus saepe velit vero. Aliquid animi aperiam aspernatur assumenda at atque beatae cum delectus, dolores, ipsam itaque labore molestias neque, nostrum quibusdam quis reiciendis similique sunt unde voluptatibus? Accusantium adipisci asperiores atque culpa delectus deserunt dolor ducimus ea eius eum excepturi facere facilis hic id, nam neque officia, placeat quisquam quod repellat sapiente soluta sunt unde vel voluptate? Ad aperiam commodi culpa deserunt dicta distinctio ea eaque itaque iusto maxime molestiae neque nisi odio, optio perspiciatis porro quae quia quidem rem repellat suscipit, unde, vel vero? Deleniti ducimus excepturi explicabo incidunt ipsa ipsam magnam minus nemo nisi odit quae qui quidem recusandae, sed sint ut veniam vero! Dolores doloribus, eos excepturi harum itaque minima non odio provident ullam vel! Fuga incidunt mollitia obcaecati possimus!'),
//(7, 'xzc', '2016-09-16 13:34:01', 'asd'),
//(8, 'anon', '2016-09-16 13:37:13', 'vse tlen :<'),
//(9, 'user', '2016-09-16 13:38:54', 'some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text some text '),
//(10, 'qwerty', '2016-09-16 13:41:30', 'bl'),
//(11, 'asda123', '2016-09-16 13:42:11', 'alsd kadl aksd laglkdlfng dfjng djfg ndjfg jdf gldfgk df '),
//(12, 'anon', '2016-09-16 13:43:55', 'pooooooooost post post pooost'),
//(13, 'cvvc', '2016-09-19 12:20:11', 'gfgffgfg'),
//(14, 'new', '2016-09-19 12:37:16', 'asdla;d akf lsdg dkl;sfg dfg d'),
//(15, 'efg', '2016-09-19 17:02:52', 'sdfgc'),
//(16, 'ttt', '2016-09-19 17:13:04', 'aSzdxfcvbcbc dd dg dg gd '),
//(17, 'zzz', '2016-09-20 10:53:27', 'ad asd gdfg dfgdfg df  '),
//(18, 'Semen', '2016-09-20 11:13:49', 'Nice blojek'),
//(19, 'anon', '2016-09-20 11:23:45', 'some post '),
//(20, 'anon', '2016-09-20 11:46:25', 'local post'),
//(21, 'vasok', '2016-09-20 12:40:37', 'vse ok'),
//(22, 'jyj', '2016-09-21 10:36:24', 'ssssssssssssss ss ');

//        $this->batchInsert('records_v2', ['id', 'author', 'date', 'text'], [
//            [2, 'Петя', '2016-09-14 21:15:51', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut beatae commodi cum, dolore earum enim esse ex illo illum in laborum libero maxime molestiae natus nihil placeat porro quo repellat sed sequi tempora vel veritatis vero voluptatem. Accusamus debitis ducimus eaque excepturi in iusto minus neque quam repellendus sunt. Alias consectetur consequatur delectus dolores eaque earum excepturi explicabo id, itaque molestias officia officiis quae quod sit voluptas. Ab aperiam atque nemo nihil odio quibusdam sint vero vitae! Accusantium cupiditate dolores doloribus ipsum iste, maiores maxime minima minus neque perferendis perspiciatis quaerat qui reprehenderit sunt, suscipit velit voluptatum.'],
//            [3, 'Вася', '2016-09-14 16:11:45', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi atque aut beatae commodi cum, dolore earum enim esse ex illo illum in laborum libero maxime molestiae natus nihil placeat porro quo repellat sed sequi tempora vel veritatis vero voluptatem. Accusamus debitis ducimus eaque excepturi in iusto minus neque quam repellendus sunt. Alias consectetur consequatur delectus dolores eaque earum excepturi explicabo id, itaque molestias officia officiis quae quod sit voluptas. Ab aperiam atque nemo nihil odio quibusdam sint vero vitae! Accusantium cupiditate dolores doloribus ipsum iste, maiores maxime minima minus neque perferendis perspiciatis quaerat qui reprehenderit sunt, suscipit velit voluptatum.'],
//        ]);

    }

    public function down()
    {
        $this->delete("records_v2", "id > 1");

//        echo "m160926_102827_insert_records_data cannot be reverted.\n";
//
//        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
