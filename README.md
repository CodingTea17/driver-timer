# The Original Driver Timer (Frankenstein)
--------

## Concept
--------
The idea was to create a simple application to increase delivery efficiency. Drivers were required to call back after every delivery so that shift leads could route the upcoming deliveries and 'insiders' could prepare those orders to be ready as soon as the driver returned. Ideally a driver would return from a delivery and immediately leave on the next. However, that was almost never the case. During rush periods shift leads were unable to mentally keep track of who was returning and phone calls to the store was often not even reported to the shift lead. Drivers would return and the next delivery would not have even been 'slapped out', delaying the order by 15+ minutes.

#### Goals of the Driver Timer:

* Provide accurate, consistent communication between the drivers and shift lead
* Reduce distractions for driver (e.g. making a phone call while driving back to the store)
* Improve delivery overall times by cutting down out-the-door times

#### Tech

In order to accomplish these goals I created a single page application that recieved text messages through the Twilio API and displayed a countdown for when a given driver would return. The driver would send a number (e.g. 10) and a countdown would begin followed by an audible beeping sound to notify those around the tablet that a driver was returning.
#### Results

It worked amazingly. I no longer had to juggle my phone while trying to shift through gears on my little Geo Metro, the shift leaders now knew which drivers would be returning and an approximation of when, and drivers no longer had to wait 15+ minutes for their next delivery. 

#### Looking Forward

While it works, the code is my frankenstein monster. This is my first web application and I know it needs a lot of work. For example, I had to hard code the drivers which isn't terrible because we don't get new drivers every day. There's also a lot of poorly written test code that was written with good intentions. A future feature to add to the application would be the ability to add multiple stores.

EDIT: This version became depreciated when my free trial from Twilio abruptly ended... It would've costed ~$5 per month to keep using Twilio and I didn't want to do that so I looked for other solutions. Cue V2 (feat. Nexmo).
TODO: Get a screenshot of the application (app doesn't want to run without Twilio auth which was revoked when the trial ended)