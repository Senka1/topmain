import os
import openai
openai.organization = "org-xBe6mbOQu0NnDD77bRAwmG3u"
openai.api_key = os.getenv("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")
openai.Model.list()