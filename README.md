#Vor.PHP.SQL

The PHP and MySQL implementation of the Vor Application Group.
The Vor Application Group is a set of small applications that help you launch a quality website FAST.

Basically, it's a bunch of different systems you normally find separately in one big, gorgeous bundle designed to help those of us who are not developers to launch an amazing website very quickly with all the bells and whistles you could expect to be added by a major development studio.

##Credit
Why | Link
------------ | -------------
http://www.panopta.com/2013/02/06/bootstrap-application-wizard-2 | The installation wizard
https://gist.github.com/avdg/2210109 | Installation popups hiding after a few seconds
http://cryptojs.altervista.org/js-php | Idea of how to securely transfer data
http://getbootstrap.com | Most of the styling

##Todo
- [ ] Remove Actual Bootstrap (include it through CDNJS)
- [ ] Make the setup wizard my own, that way it will fit better with the themes (instead of using the [Bootstrap Application Wizard](https://github.com/amoffat/bootstrap-application-wizard))
- [ ] Encryption (possible models: [1](http://cryptojs.altervista.org/js-php/))
  - [ ] JS (front-end) and PHP (back-end + front-end) compatible, AES-complaint, super strong encryption and decryption function set ()
  - [ ] Implement it everywhere things should be encrypted
- [ ] Make the forums system
  - [ ] Make forums
  - [ ] Make categories
  - [ ] Make threads
  - [ ] Reply to threads
  - [ ] Sticky threads
  - [ ] Delete threads and replies
  - [ ] Report threads and replies
  - [ ] Voting on threads and replies
  - [ ] Collapsing of lowly rated replies
  - [ ] Edit threads and replies
  - [ ] Optional link conversion in threads and replies in order to track them
  - [ ] Optional image conversion in threads and replies so that when someone says example.com/image.png it converts it to that image
  - [ ] Markdown using a JS textarea modifier
  - [ ] A preview pane for threads in progress
  - [ ] Saving of threads as drafts
- [ ] Blog System
  - [ ] Make new posts
  - [ ] Edit posts
  - [ ] Delete posts
  - [ ] Delay publishing of posts
  - [ ] Detailed tracking of visits to posts
  - [ ] Make new people authors
  - [ ] Remove people as authors
  - [ ] Voting on posts
  - [ ] Make new comments on posts
  - [ ] Edit comments (inline)
  - [ ] Delete comments
  - [ ] Vote on comments
  - [ ] Choose how to sort comments (standard: most votes)
  - [ ] Collapsing of lowly rated comments
- [ ] Link Shrinker
  - [ ] Make [Zbee/linkShrinker.PHP](https://github.com/Zbee/linkShrinker.PHP) compatible with the Vor configuration
  - [ ] More intense tracking for the link shrinker
  - [ ] Administration panel for the link shrinker
  - [ ] See the links shrunk by you
  - [ ] Add notes to links
  - [ ] Optional monetization of links (ad on redirect page)
- [ ] Login System
  - [ ] Adapt [Zbee/loginSystem.PHP](https://github.com/Zbee/loginSystem.PHP) compatible with the Vor configuration
  - [ ] Custom ranks
  - [ ] Administration panel for the users (all panels are combined into the same place)
  - [ ] Latest activity by user
  - [ ] Account deletion queueing (when users decide to delete their account, it's deactivated but still exists for ... 7(?) days)
  - [ ] Separation between deletion of just the account, and deleting everything associated with the account (posts, comments, threads, links, etc)
  - [ ] Make a rich UCP
  - [ ] Let users subscribe to different notifications
- [ ] Logging System (logging system and user actions)
  - [ ] Make new entries
  - [ ] Flag entries for later
  - [ ] Make it possible to see if there were X many logs by a certain user in a certain period to prevent spamming
  - [ ] Make rollbacks possible
  - [ ] Contain a JSON style content of the new data and the old data (optional feature?)
- [ ] More Things!