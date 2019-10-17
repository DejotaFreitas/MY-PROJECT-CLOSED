
local frame = CreateFrame("FRAME", "212");
frame:RegisterEvent("PLAYER_LOGIN");
function eventHandler(self, event, ...)
	ChatFrameChannelButton:Hide()
	ChatFrameToggleVoiceDeafenButton:Hide()
	ChatFrameToggleVoiceMuteButton:Hide()
end
frame:SetScript("OnEvent", eventHandler);

ChatFrame1ButtonFrame:Hide()

-- ===========================================================================
_CHATHIDE=not _CHATHIDE for i=1,NUM_CHAT_WINDOWS do for _,v in pairs{"","Tab"} do local f=_G["ChatFrame"..i..v] if _CHATHIDE then f.v=f:IsVisible() end f.ORShow=f.ORShow or f.Show f.Show=_CHATHIDE and f.Hide or f.ORShow if f.v then f:Show() end end end

QuickJoinToastButton:Hide()
ChatFrameMenuButton:Hide()
FriendsMicroButton:Hide()
