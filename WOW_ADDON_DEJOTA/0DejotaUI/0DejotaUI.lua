MainMenuBarArtFrame.LeftEndCap:Hide();
MainMenuBarArtFrame.RightEndCap:Hide();
MainMenuBarArtFrameBackground:Hide();
MainMenuBarArtFrame.PageNumber:Hide();
ActionBarUpButton:Hide();
ActionBarDownButton:Hide();

-- BAG BAR
MicroButtonAndBagsBar:Hide();

-- MICRO MENU
CharacterMicroButton:Hide();
SpellbookMicroButton:Hide();
TalentMicroButton:Hide();
AchievementMicroButton:Hide();
QuestLogMicroButton:Hide();
GuildMicroButton:Hide();
LFDMicroButton:Hide();
EJMicroButton:Hide();
CollectionsMicroButton:Hide();
MainMenuMicroButton:Hide();
HelpMicroButton:Hide();
StoreMicroButton:SetScript("OnShow",StoreMicroButton.Hide);
StoreMicroButton:Hide();

-- =====================================
ExtraActionButton1:SetScale(0.8);
ExtraActionButton1.style:SetAlpha(0);

-- =====================================
MultiBarRight:ClearAllPoints()
MultiBarRight:SetSize(MultiBarBottomLeft:GetWidth(),MultiBarBottomLeft:GetHeight())
MultiBarRight:SetPoint("BottomRight",UIParent,"BottomRight",0,5)
MultiBarRight.SetPoint = function() end

MultiBarLeft:ClearAllPoints()
MultiBarLeft:SetSize(MultiBarBottomLeft:GetWidth(),MultiBarBottomLeft:GetHeight())
MultiBarLeft:SetPoint("BottomLeft",MultiBarRight,"TopLeft",0,5)

for i = 1,12 do
	_G["MultiBarLeftButton"..i]:ClearAllPoints()
	_G["MultiBarRightButton"..i]:ClearAllPoints()
	if i == 1 then
		_G["MultiBarLeftButton"..i]:SetPoint("BottomLeft",-10,36)
		_G["MultiBarRightButton"..i]:SetPoint("BottomLeft",-10,14)
	else
		_G["MultiBarLeftButton"..i]:SetPoint("Left",_G["MultiBarLeftButton"..tostring(i-1)],"Right",6,0)
		_G["MultiBarRightButton"..i]:SetPoint("Left",_G["MultiBarRightButton"..tostring(i-1)],"Right",6,0)
	end
end

-- ===============FUNCAO========================
function hide_chat()
	for i = 1, NUM_CHAT_WINDOWS do
		_G["ChatFrame"..i]:SetAlpha(0)
	end
end

function show_chat()
	for i = 1, NUM_CHAT_WINDOWS do
		_G["ChatFrame"..i]:SetAlpha(1)
	end
end

-- ===============VARIAVEIS========================
local ESCALA = 0.6;
local PONTO_ESQUERDO = -100;

local toggleAlphaMinimap = 1
local toggleAlphaChat = 1
local toggleAlphaBuff = 1
local toggleAlphaPlayerTarget = 1

local f=CreateFrame("Frame")

f:SetScript("OnEvent", function(self, event, ...)

	if event=="PLAYER_LOGIN" then
    -- PartyMemberFrame1:SetAlpha(0.5)
    -- PartyMemberFrame2:SetAlpha(0.5)
    -- PartyMemberFrame3:SetAlpha(0.5)
    -- PartyMemberFrame4:SetAlpha(0.5)

		MainMenuBar:HookScript("OnUpdate", function()
			MainMenuBar:SetScale(0.7)
			MainMenuBar:ClearAllPoints()
			MainMenuBar:SetPoint("CENTER", UIParent, "BOTTOM", -100, 40)
			MultiBarLeft:SetScale(0.7)
			MultiBarRight:SetScale(0.7)
			MultiBarLeft:Show()
			MultiBarRight:Show()
		end)

-- ===============================================
		hide_chat()
		for i = 1, NUM_CHAT_WINDOWS do
			-- _G["ChatFrame"..i]:SetScript("OnEvent", function() if toggleAlphaChat==1 then _G["ChatFrame"..i]:SetAlpha(0) end end)
			_G["ChatFrame"..i]:SetScript("OnEnter", function() if toggleAlphaChat==1 then _G["ChatFrame"..i]:SetAlpha(1) end end)
			_G["ChatFrame"..i]:SetScript("OnLeave", function() if toggleAlphaChat==1 then _G["ChatFrame"..i]:SetAlpha(0) end end)
			_G["ChatFrame"..i]:SetScript("OnMouseDown", function(self, button)
				if button=="LeftButton" then
					if toggleAlphaChat == 1 then
						toggleAlphaChat = 0
						_G["ChatFrame"..i]:SetAlpha(1)
					else
						toggleAlphaChat = 1
						_G["ChatFrame"..i]:SetAlpha(0)
			end	end	end)
	end

-- ===============================================
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

-- ===============================================
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
					TargetFrame:SetAlpha(1)
					PlayerFrame:SetAlpha(1)
					Minimap:GetParent():SetAlpha(1)
					BuffFrame:Show()
		      TemporaryEnchantFrame:Show()
					show_chat()
					toggleAlphaPlayerTarget = 0
					toggleAlphaBuff = 0
					toggleAlphaChat = 0
				else
					TargetFrame:SetAlpha(0)
					PlayerFrame:SetAlpha(0)
					Minimap:GetParent():SetAlpha(0)
					BuffFrame:Hide()
		      TemporaryEnchantFrame:Hide()
					hide_chat()
					toggleAlphaPlayerTarget = 1
					toggleAlphaBuff = 1
					toggleAlphaChat = 1
		end	end	end)

		TargetFrame:HookScript("OnMouseDown", function(self, button)
			if button=="LeftButton" then
				if toggleAlphaPlayerTarget==1 then
					TargetFrame:SetAlpha(1)
					PlayerFrame:SetAlpha(1)
					Minimap:GetParent():SetAlpha(1)
					BuffFrame:Show()
					TemporaryEnchantFrame:Show()
					show_chat()
					toggleAlphaPlayerTarget = 0
					toggleAlphaBuff = 0
					toggleAlphaChat = 0
				else
					TargetFrame:SetAlpha(0)
					PlayerFrame:SetAlpha(0)
					Minimap:GetParent():SetAlpha(0)
					BuffFrame:Hide()
					TemporaryEnchantFrame:Hide()
					hide_chat()
					toggleAlphaPlayerTarget = 1
					toggleAlphaBuff = 1
					toggleAlphaChat = 1
		end	end	end)

    BuffFrame:Hide()
    TemporaryEnchantFrame:Hide()

	elseif event=="PLAYER_REGEN_DISABLED" then
		-- ObjectiveTrackerFrame:SetAlpha(0)

	elseif event=="PLAYER_REGEN_ENABLED" then
		-- ObjectiveTrackerFrame:SetAlpha(1)

  elseif event=="PLAYER_TARGET_CHANGED" then
    if UnitExists("target") then
			if toggleAlphaBuff == 1 then
	      BuffFrame:Show()
	      TemporaryEnchantFrame:Show()
			end
    else
			if toggleAlphaBuff == 1 then
	      BuffFrame:Hide()
	      TemporaryEnchantFrame:Hide()
			end
    end
	end

end)
-- ===========================================================================
f:RegisterEvent("PLAYER_LOGIN")
f:RegisterEvent("PLAYER_REGEN_DISABLED")
f:RegisterEvent("PLAYER_REGEN_ENABLED")
f:RegisterEvent("PLAYER_TARGET_CHANGED")
