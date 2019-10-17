local toggleAlphaMinimap = 1;
local toggleAlphaPlayerTarget = 1;
local f=CreateFrame("Frame")

f:SetScript("OnEvent", function(self, event, ...)

	if event=="PLAYER_LOGIN" then
    PartyMemberFrame1:SetAlpha(0.5)
    PartyMemberFrame2:SetAlpha(0.5)
    PartyMemberFrame3:SetAlpha(0.5)
    PartyMemberFrame4:SetAlpha(0.5)

    Minimap:GetParent():SetAlpha(0)
    Minimap:SetScript("OnEnter", function()
			if toggleAlphaMinimap==1 then
				Minimap:GetParent():SetAlpha(1)
		end end)

    Minimap:SetScript("OnLeave", function()
			if toggleAlphaMinimap==1 then
				Minimap:GetParent():SetAlpha(0)
		end end)

    Minimap:HookScript("OnMouseDown", function(self,button)
      if button=="LeftButton" then
				if toggleAlphaMinimap==1 then
					toggleAlphaMinimap=0
					Minimap:GetParent():SetAlpha(1)
				else
					toggleAlphaMinimap=1
					Minimap:GetParent():SetAlpha(0)
		end end end)

    PlayerFrame:SetAlpha(0)
    PlayerFrame:SetScript("OnEnter", function()
			if toggleAlphaPlayerTarget==1 then
				PlayerFrame:SetAlpha(1)
				TargetFrame:SetAlpha(1)
		end end)

    PlayerFrame:SetScript("OnLeave", function()
			if toggleAlphaPlayerTarget==1 then
				PlayerFrame:SetAlpha(0)
				TargetFrame:SetAlpha(0)
		end end)

    TargetFrame:SetAlpha(0)
    TargetFrame:SetScript("OnEnter", function()
			if toggleAlphaPlayerTarget==1 then
				TargetFrame:SetAlpha(1)
				PlayerFrame:SetAlpha(1)
		end end)

    TargetFrame:SetScript("OnLeave", function()
			if toggleAlphaPlayerTarget==1 then
			TargetFrame:SetAlpha(0)
			PlayerFrame:SetAlpha(0)
		end end)

		PlayerFrame:HookScript("OnMouseDown", function(self, button)
      if button=="LeftButton" then
				if toggleAlphaPlayerTarget==1 then
					toggleAlphaPlayerTarget=0
					TargetFrame:SetAlpha(1)
					PlayerFrame:SetAlpha(1)
					Minimap:GetParent():SetAlpha(1)
					print("logging")
				else
					toggleAlphaPlayerTarget=1
					TargetFrame:SetAlpha(0)
					PlayerFrame:SetAlpha(0)
					Minimap:GetParent():SetAlpha(0)
		end	end	end)

		TargetFrame:HookScript("OnMouseDown", function(self, button)
		  if button=="LeftButton" then
				if toggleAlphaPlayerTarget==1 then
					toggleAlphaPlayerTarget=0
					TargetFrame:SetAlpha(1)
					PlayerFrame:SetAlpha(1)
					Minimap:GetParent():SetAlpha(1)
					print("logging")
				else
					toggleAlphaPlayerTarget=1
					TargetFrame:SetAlpha(0)
					PlayerFrame:SetAlpha(0)
					Minimap:GetParent():SetAlpha(0)
		end	end	end)

    BuffFrame:Hide()
    TemporaryEnchantFrame:Hide()

	elseif event=="PLAYER_REGEN_DISABLED" then
		ObjectiveTrackerFrame:SetAlpha(0)

	elseif event=="PLAYER_REGEN_ENABLED" then
		ObjectiveTrackerFrame:SetAlpha(1)

  elseif event=="PLAYER_TARGET_CHANGED" then
    if UnitExists("target") then
      BuffFrame:Show()
      TemporaryEnchantFrame:Show()
    else
      BuffFrame:Hide()
      TemporaryEnchantFrame:Hide()
    end
	end

end)
-- ===========================================================================
f:RegisterEvent("PLAYER_LOGIN")
f:RegisterEvent("PLAYER_REGEN_DISABLED")
f:RegisterEvent("PLAYER_REGEN_ENABLED")
f:RegisterEvent("PLAYER_TARGET_CHANGED")
