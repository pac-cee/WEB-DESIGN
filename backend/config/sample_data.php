<?php
// Check if there are any categories
$stmt = $conn->prepare("SELECT COUNT(*) FROM categories");
$stmt->execute();
$categoryCount = $stmt->fetchColumn();

// Only insert sample data if there are no categories
if ($categoryCount === 0) {
    // Insert sample categories
    $categories = [
        ['name' => 'Fiction', 'slug' => 'fiction', 'description' => 'Novels, short stories, and other fictional works'],
        ['name' => 'Non-Fiction', 'slug' => 'non-fiction', 'description' => 'Biographies, memoirs, self-help, and educational books'],
        ['name' => 'Mystery', 'slug' => 'mystery', 'description' => 'Suspense, detective, and crime novels'],
        ['name' => 'Science Fiction', 'slug' => 'science-fiction', 'description' => 'Science fiction, fantasy, and speculative fiction'],
        ['name' => 'Biography', 'slug' => 'biography', 'description' => 'Biographies and autobiographies of notable individuals'],
        ['name' => 'History', 'slug' => 'history', 'description' => 'Books about historical events, periods, and figures']
    ];
    
    $stmt = $conn->prepare("INSERT INTO categories (name, slug, description) VALUES (:name, :slug, :description)");
    
    foreach ($categories as $category) {
        $stmt->bindParam(':name', $category['name']);
        $stmt->bindParam(':slug', $category['slug']);
        $stmt->bindParam(':description', $category['description']);
        $stmt->execute();
    }
    
    // Insert sample books
    $books = [
        [
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'description' => 'Set in the American South during the 1930s, the novel tells the story of a lawyer who defends a Black man falsely accused of rape, as seen through the eyes of the lawyer\'s young daughter.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/5834/nature-grass-leaf-green.jpg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780061120084',
            'publisher' => 'Harper Perennial Modern Classics',
            'publication_date' => '1960-07-11',
            'pages' => 336,
            'language' => 'English',
            'stock_quantity' => 25,
            'featured' => true
        ],
        [
            'title' => '1984',
            'author' => 'George Orwell',
            'description' => 'A dystopian novel set in a totalitarian society ruled by the Party, which has total control over every aspect of people\'s lives.',
            'price' => 10.99,
            'original_price' => 14.99,
            'cover_image' => 'https://images.pexels.com/photos/590493/pexels-photo-590493.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780451524935',
            'publisher' => 'Signet Classic',
            'publication_date' => '1949-06-08',
            'pages' => 328,
            'language' => 'English',
            'stock_quantity' => 18,
            'featured' => true
        ],
        [
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'description' => 'Set in the Jazz Age, the novel tells the tragic story of Jay Gatsby and his pursuit of Daisy Buchanan.',
            'price' => 11.99,
            'original_price' => 13.99,
            'cover_image' => 'https://images.pexels.com/photos/46274/pexels-photo-46274.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780743273565',
            'publisher' => 'Scribner',
            'publication_date' => '1925-04-10',
            'pages' => 180,
            'language' => 'English',
            'stock_quantity' => 0,
            'featured' => false
        ],
        [
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'description' => 'A romantic novel following the character development of Elizabeth Bennet, who learns about the repercussions of hasty judgments.',
            'price' => 9.99,
            'original_price' => 12.99,
            'cover_image' => 'https://images.pexels.com/photos/1130980/pexels-photo-1130980.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780141439518',
            'publisher' => 'Penguin Classics',
            'publication_date' => '1813-01-28',
            'pages' => 432,
            'language' => 'English',
            'stock_quantity' => 32,
            'featured' => true
        ],
        [
            'title' => 'The Hobbit',
            'author' => 'J.R.R. Tolkien',
            'description' => 'A fantasy novel about the adventures of hobbit Bilbo Baggins, who is hired as a "burglar" by a group of dwarves seeking to reclaim their treasure from a dragon.',
            'price' => 14.99,
            'original_price' => 17.99,
            'cover_image' => 'https://images.pexels.com/photos/1563075/pexels-photo-1563075.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780547928227',
            'publisher' => 'Houghton Mifflin Harcourt',
            'publication_date' => '1937-09-21',
            'pages' => 304,
            'language' => 'English',
            'stock_quantity' => 28,
            'featured' => true
        ],
        [
            'title' => 'The Da Vinci Code',
            'author' => 'Dan Brown',
            'description' => 'A mystery thriller novel following symbologist Robert Langdon as he investigates a murder in the Louvre Museum.',
            'price' => 11.99,
            'original_price' => 14.99,
            'cover_image' => 'https://images.pexels.com/photos/46792/the-ball-stadion-football-the-pitch-46792.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 3, // Mystery
            'isbn' => '9780307474278',
            'publisher' => 'Anchor',
            'publication_date' => '2003-03-18',
            'pages' => 597,
            'language' => 'English',
            'stock_quantity' => 42,
            'featured' => false
        ],
        [
            'title' => 'Steve Jobs',
            'author' => 'Walter Isaacson',
            'description' => 'The exclusive biography of Steve Jobs, based on more than forty interviews with Jobs conducted over two years.',
            'price' => 19.99,
            'original_price' => 24.99,
            'cover_image' => 'https://images.pexels.com/photos/256262/pexels-photo-256262.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 5, // Biography
            'isbn' => '9781451648539',
            'publisher' => 'Simon & Schuster',
            'publication_date' => '2011-10-24',
            'pages' => 656,
            'language' => 'English',
            'stock_quantity' => 15,
            'featured' => false
        ],
        [
            'title' => 'Sapiens: A Brief History of Humankind',
            'author' => 'Yuval Noah Harari',
            'description' => 'A book that explores the history of the human species, from the evolution of archaic human species to the present.',
            'price' => 16.99,
            'original_price' => 19.99,
            'cover_image' => 'https://images.pexels.com/photos/4666751/pexels-photo-4666751.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 2, // Non-Fiction
            'isbn' => '9780062316097',
            'publisher' => 'Harper',
            'publication_date' => '2015-02-10',
            'pages' => 464,
            'language' => 'English',
            'stock_quantity' => 23,
            'featured' => true
        ],
        [
            'title' => 'Gone Girl',
            'author' => 'Gillian Flynn',
            'description' => 'A thriller novel about the disappearance of a woman on her fifth wedding anniversary.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/256450/pexels-photo-256450.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 3, // Mystery
            'isbn' => '9780307588371',
            'publisher' => 'Crown Publishing Group',
            'publication_date' => '2012-06-05',
            'pages' => 422,
            'language' => 'English',
            'stock_quantity' => 19,
            'featured' => false
        ],
        [
            'title' => 'The Catcher in the Rye',
            'author' => 'J.D. Salinger',
            'description' => 'A novel about a teenage boy\'s experiences in New York City after being expelled from his prep school.',
            'price' => 10.99,
            'original_price' => 13.99,
            'cover_image' => 'https://images.pexels.com/photos/358532/pexels-photo-358532.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780316769488',
            'publisher' => 'Little, Brown and Company',
            'publication_date' => '1951-07-16',
            'pages' => 240,
            'language' => 'English',
            'stock_quantity' => 27,
            'featured' => false
        ],
        [
            'title' => 'The Lord of the Rings',
            'author' => 'J.R.R. Tolkien',
            'description' => 'An epic high-fantasy novel set in Middle-earth, following the hobbit Frodo Baggins and the Fellowship of the Ring on a quest to destroy the One Ring.',
            'price' => 29.99,
            'original_price' => 34.99,
            'cover_image' => 'https://images.pexels.com/photos/2437299/pexels-photo-2437299.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780618640157',
            'publisher' => 'Houghton Mifflin Harcourt',
            'publication_date' => '1954-07-29',
            'pages' => 1178,
            'language' => 'English',
            'stock_quantity' => 22,
            'featured' => false
        ],
        [
            'title' => 'A Brief History of Time',
            'author' => 'Stephen Hawking',
            'description' => 'A book that explores the nature of time, space, and the universe.',
            'price' => 15.99,
            'original_price' => 18.99,
            'cover_image' => 'https://images.pexels.com/photos/2150/sky-space-dark-galaxy.jpg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 2, // Non-Fiction
            'isbn' => '9780553380163',
            'publisher' => 'Bantam',
            'publication_date' => '1988-04-01',
            'pages' => 212,
            'language' => 'English',
            'stock_quantity' => 3,
            'featured' => false
        ],
        // Added 20 more books below
        [
            'title' => 'Becoming',
            'author' => 'Michelle Obama',
            'description' => 'An intimate memoir by the former First Lady of the United States that recounts her experiences from childhood through her time in the White House.',
            'price' => 18.99,
            'original_price' => 24.99,
            'cover_image' => 'https://images.pexels.com/photos/6373305/pexels-photo-6373305.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 5, // Biography
            'isbn' => '9781524763138',
            'publisher' => 'Crown Publishing',
            'publication_date' => '2018-11-13',
            'pages' => 448,
            'language' => 'English',
            'stock_quantity' => 31,
            'featured' => true
        ],
        [
            'title' => 'The Silent Patient',
            'author' => 'Alex Michaelides',
            'description' => 'A psychological thriller about a woman who shoots her husband and then stops speaking, and the therapist determined to unravel the mystery of her silence.',
            'price' => 13.99,
            'original_price' => 16.99,
            'cover_image' => 'https://images.pexels.com/photos/1765033/pexels-photo-1765033.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 3, // Mystery
            'isbn' => '9781250301697',
            'publisher' => 'Celadon Books',
            'publication_date' => '2019-02-05',
            'pages' => 336,
            'language' => 'English',
            'stock_quantity' => 27,
            'featured' => true
        ],
        [
            'title' => 'Dune',
            'author' => 'Frank Herbert',
            'description' => 'A science fiction novel set in the distant future amidst a feudal interstellar society where noble houses control individual planets.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/4947748/pexels-photo-4947748.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780441172719',
            'publisher' => 'Ace Books',
            'publication_date' => '1965-08-01',
            'pages' => 412,
            'language' => 'English',
            'stock_quantity' => 34,
            'featured' => true
        ],
        [
            'title' => 'The Power of Habit',
            'author' => 'Charles Duhigg',
            'description' => 'An examination of the science behind habit creation and reformation, explaining how habits work, how they can be changed, and their impact on our lives.',
            'price' => 14.99,
            'original_price' => 17.99,
            'cover_image' => 'https://images.pexels.com/photos/4065624/pexels-photo-4065624.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 2, // Non-Fiction
            'isbn' => '9780812981605',
            'publisher' => 'Random House',
            'publication_date' => '2012-02-28',
            'pages' => 371,
            'language' => 'English',
            'stock_quantity' => 18,
            'featured' => false
        ],
        [
            'title' => 'The Alchemist',
            'author' => 'Paulo Coelho',
            'description' => 'A philosophical novel about a young Andalusian shepherd who dreams of finding worldly treasures and embarks on a journey to fulfill his personal legend.',
            'price' => 11.99,
            'original_price' => 14.99,
            'cover_image' => 'https://images.pexels.com/photos/3310691/pexels-photo-3310691.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780062315007',
            'publisher' => 'HarperOne',
            'publication_date' => '1988-01-01',
            'pages' => 208,
            'language' => 'English',
            'stock_quantity' => 42,
            'featured' => true
        ],
        [
            'title' => 'Educated',
            'author' => 'Tara Westover',
            'description' => 'A memoir about a young girl who, kept out of school, leaves her survivalist family and goes on to earn a PhD from Cambridge University.',
            'price' => 15.99,
            'original_price' => 18.99,
            'cover_image' => 'https://images.pexels.com/photos/6147369/pexels-photo-6147369.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 5, // Biography
            'isbn' => '9780399590504',
            'publisher' => 'Random House',
            'publication_date' => '2018-02-20',
            'pages' => 334,
            'language' => 'English',
            'stock_quantity' => 22,
            'featured' => false
        ],
        [
            'title' => 'The Girl with the Dragon Tattoo',
            'author' => 'Stieg Larsson',
            'description' => 'A crime thriller that follows journalist Mikael Blomkvist and hacker Lisbeth Salander as they investigate the disappearance of a woman from a wealthy family.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/4065391/pexels-photo-4065391.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 3, // Mystery
            'isbn' => '9780307949486',
            'publisher' => 'Vintage Crime/Black Lizard',
            'publication_date' => '2008-09-16',
            'pages' => 672,
            'language' => 'English',
            'stock_quantity' => 16,
            'featured' => false
        ],
        [
            'title' => 'The Immortal Life of Henrietta Lacks',
            'author' => 'Rebecca Skloot',
            'description' => 'The story of Henrietta Lacks, a woman whose cells were used without her knowledge to create the first immortal human cell line, and the profound impact on modern medicine.',
            'price' => 13.99,
            'original_price' => 16.99,
            'cover_image' => 'https://images.pexels.com/photos/3825586/pexels-photo-3825586.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 2, // Non-Fiction
            'isbn' => '9781400052189',
            'publisher' => 'Crown Publishing Group',
            'publication_date' => '2010-02-02',
            'pages' => 381,
            'language' => 'English',
            'stock_quantity' => 14,
            'featured' => false
        ],
        [
            'title' => 'The Road',
            'author' => 'Cormac McCarthy',
            'description' => 'A post-apocalyptic novel following a father and son\'s journey through a desolate America, struggling to survive in a world devoid of resources and filled with danger.',
            'price' => 11.99,
            'original_price' => 14.99,
            'cover_image' => 'https://images.pexels.com/photos/531321/pexels-photo-531321.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780307387899',
            'publisher' => 'Vintage Books',
            'publication_date' => '2006-09-26',
            'pages' => 287,
            'language' => 'English',
            'stock_quantity' => 9,
            'featured' => false
        ],
        [
            'title' => 'The Wright Brothers',
            'author' => 'David McCullough',
            'description' => 'The dramatic story of Wilbur and Orville Wright, the two brothers who changed the world with the invention of the airplane.',
            'price' => 16.99,
            'original_price' => 19.99,
            'cover_image' => 'https://images.pexels.com/photos/76957/tree-top-view-aircraft-trail-76957.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 6, // History
            'isbn' => '9781476728742',
            'publisher' => 'Simon & Schuster',
            'publication_date' => '2015-05-05',
            'pages' => 336,
            'language' => 'English',
            'stock_quantity' => 12,
            'featured' => false
        ],
        [
            'title' => 'Neuromancer',
            'author' => 'William Gibson',
            'description' => 'A groundbreaking cyberpunk novel that follows a washed-up computer hacker hired for one last job, which draws him into a web of intrigue and danger.',
            'price' => 10.99,
            'original_price' => 13.99,
            'cover_image' => 'https://images.pexels.com/photos/1089438/pexels-photo-1089438.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780441569595',
            'publisher' => 'Ace Books',
            'publication_date' => '1984-07-01',
            'pages' => 271,
            'language' => 'English',
            'stock_quantity' => 23,
            'featured' => false
        ],
        [
            'title' => 'The Sixth Extinction',
            'author' => 'Elizabeth Kolbert',
            'description' => 'An exploration of the ongoing Holocene extinction, potentially the sixth mass extinction in Earth\'s history, caused by human activity.',
            'price' => 14.99,
            'original_price' => 17.99,
            'cover_image' => 'https://images.pexels.com/photos/50594/sea-bay-waterfront-beach-50594.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 2, // Non-Fiction
            'isbn' => '9781250062185',
            'publisher' => 'Picador',
            'publication_date' => '2014-02-11',
            'pages' => 336,
            'language' => 'English',
            'stock_quantity' => 17,
            'featured' => false
        ],
        [
            'title' => 'The Nightingale',
            'author' => 'Kristin Hannah',
            'description' => 'A historical novel set in France during World War II, following two sisters as they struggle to survive and resist the German occupation.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/2088233/pexels-photo-2088233.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9781250080400',
            'publisher' => 'St. Martin\'s Griffin',
            'publication_date' => '2015-02-03',
            'pages' => 440,
            'language' => 'English',
            'stock_quantity' => 29,
            'featured' => false
        ],
        [
            'title' => 'In Cold Blood',
            'author' => 'Truman Capote',
            'description' => 'A non-fiction novel detailing the 1959 murders of four members of the Herbert Clutter family in the small farming community of Holcomb, Kansas.',
            'price' => 10.99,
            'original_price' => 13.99,
            'cover_image' => 'https://images.pexels.com/photos/172277/pexels-photo-172277.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 3, // Mystery
            'isbn' => '9780679745587',
            'publisher' => 'Vintage',
            'publication_date' => '1965-01-17',
            'pages' => 343,
            'language' => 'English',
            'stock_quantity' => 21,
            'featured' => false
        ],
        [
            'title' => 'The Color Purple',
            'author' => 'Alice Walker',
            'description' => 'A novel that follows the life of African American women in the southern United States in the 1930s, addressing the issues of racism, sexism, and poverty.',
            'price' => 9.99,
            'original_price' => 12.99,
            'cover_image' => 'https://images.pexels.com/photos/1122626/pexels-photo-1122626.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780156028356',
            'publisher' => 'Mariner Books',
            'publication_date' => '1982-06-01',
            'pages' => 288,
            'language' => 'English',
            'stock_quantity' => 8,
            'featured' => false
        ],
        [
            'title' => 'Leonardo da Vinci',
            'author' => 'Walter Isaacson',
            'description' => 'A biography of the Italian Renaissance polymath that connects his art to his science and shows how his genius was based on skills we can improve in ourselves.',
            'price' => 19.99,
            'original_price' => 24.99,
            'cover_image' => 'https://images.pexels.com/photos/256431/pexels-photo-256431.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 5, // Biography
            'isbn' => '9781501139154',
            'publisher' => 'Simon & Schuster',
            'publication_date' => '2017-10-17',
            'pages' => 624,
            'language' => 'English',
            'stock_quantity' => 11,
            'featured' => false
        ],
        [
            'title' => 'The Guns of August',
            'author' => 'Barbara W. Tuchman',
            'description' => 'A detailed account of the first month of World War I, examining the decisions, strategies, and events that led to and shaped the conflict.',
            'price' => 14.99,
            'original_price' => 17.99,
            'cover_image' => 'https://images.pexels.com/photos/73833/ww1-war-soldiers-war-memorial-73833.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 6, // History
            'isbn' => '9780345476098',
            'publisher' => 'Presidio Press',
            'publication_date' => '1962-03-08',
            'pages' => 608,
            'language' => 'English',
            'stock_quantity' => 6,
            'featured' => false
        ],
        [
            'title' => 'Ready Player One',
            'author' => 'Ernest Cline',
            'description' => 'A science fiction novel set in a dystopian 2045 where people escape the real world through a virtual reality game called the OASIS.',
            'price' => 12.99,
            'original_price' => 15.99,
            'cover_image' => 'https://images.pexels.com/photos/163036/mario-luigi-yoschi-figures-163036.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 4, // Science Fiction
            'isbn' => '9780307887443',
            'publisher' => 'Crown Publishers',
            'publication_date' => '2011-08-16',
            'pages' => 374,
            'language' => 'English',
            'stock_quantity' => 38,
            'featured' => false
        ],
        [
            'title' => 'Team of Rivals',
            'author' => 'Doris Kearns Goodwin',
            'description' => 'A biographical portrait of Abraham Lincoln and the men who served with him in his cabinet, many of whom were his political rivals.',
            'price' => 18.99,
            'original_price' => 21.99,
            'cover_image' => 'https://images.pexels.com/photos/6847584/pexels-photo-6847584.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 6, // History
            'isbn' => '9780743270755',
            'publisher' => 'Simon & Schuster',
            'publication_date' => '2005-10-25',
            'pages' => 944,
            'language' => 'English',
            'stock_quantity' => 13,
            'featured' => false
        ],
        [
            'title' => 'Where the Crawdads Sing',
            'author' => 'Delia Owens',
            'description' => 'A coming-of-age story and possible murder mystery about a young woman named Kya who grows up isolated in the marshes of North Carolina.',
            'price' => 13.99,
            'original_price' => 16.99,
            'cover_image' => 'https://images.pexels.com/photos/158063/bellingrath-gardens-alabama-landscape-scenic-158063.jpeg?auto=compress&cs=tinysrgb&w=1600',
            'category_id' => 1, // Fiction
            'isbn' => '9780735219090',
            'publisher' => 'G.P. Putnam\'s Sons',
            'publication_date' => '2018-08-14',
            'pages' => 384,
            'language' => 'English',
            'stock_quantity' => 40,
            'featured' => true
        ]
    ];
    
    $stmt = $conn->prepare("
        INSERT INTO books (
            title, author, description, price, original_price, cover_image, 
            category_id, isbn, publisher, publication_date, pages, 
            language, stock_quantity, featured
        ) VALUES (
            :title, :author, :description, :price, :original_price, :cover_image, 
            :category_id, :isbn, :publisher, :publication_date, :pages, 
            :language, :stock_quantity, :featured
        )
    ");
    
    foreach ($books as $book) {
        $stmt->bindParam(':title', $book['title']);
        $stmt->bindParam(':author', $book['author']);
        $stmt->bindParam(':description', $book['description']);
        $stmt->bindParam(':price', $book['price']);
        $stmt->bindParam(':original_price', $book['original_price']);
        $stmt->bindParam(':cover_image', $book['cover_image']);
        $stmt->bindParam(':category_id', $book['category_id']);
        $stmt->bindParam(':isbn', $book['isbn']);
        $stmt->bindParam(':publisher', $book['publisher']);
        $stmt->bindParam(':publication_date', $book['publication_date']);
        $stmt->bindParam(':pages', $book['pages']);
        $stmt->bindParam(':language', $book['language']);
        $stmt->bindParam(':stock_quantity', $book['stock_quantity']);
        $stmt->bindParam(':featured', $book['featured']);
        $stmt->execute();
    }
    
    // Insert sample admin user (email: admin@example.com, password: admin123)
    $adminPassword = password_hash('admin123', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, is_admin) 
        VALUES ('Admin User', 'admin@example.com', :password, 1)
    ");
    $stmt->bindParam(':password', $adminPassword);
    $stmt->execute();
    
    // Insert sample regular user (email: user@example.com, password: user123)
    $userPassword = password_hash('user123', PASSWORD_DEFAULT);
    
    $stmt = $conn->prepare("
        INSERT INTO users (name, email, password, is_admin) 
        VALUES ('Regular User', 'user@example.com', :password, 0)
    ");
    $stmt->bindParam(':password', $userPassword);
    $stmt->execute();
}