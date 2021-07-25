## Create Conversion Trigger

- Run composer install.
- Add the key below to the .env file

        #SHOPIFY
        SHOPIFY_WEBHOOK_SECRET=<<Value here>>
        #Refersion api
        REFERSION_PUB=<<Value here>>
        REFERSION_SECRET=<<Value here>>
        REFERSION_BASE_URL="https://www.refersion.com/api/"
- endpoints: 
    - /api/webhook/product/create
    
I develop an endpoint to receive a webhook from shopify api when a product is created.
Then we are calling via api to Refersion API to create a conversion trigger.

I think the correct way should be receive the webhook and send this to a queue or 
execute a lambda because it could be that we receive a webhooks with several variants 
and the proccess may take longer that the webhook is allowable to wait for the response
