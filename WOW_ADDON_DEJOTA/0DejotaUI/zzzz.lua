

local s = Status(unit)
local cur,max=HP(unit),MaxHP(unit)
local per=Percent(cur,max)

if s then
  return s
end

if IsMouseOver() then
  return "|cff009900%s|r",HP(unit),MaxHP(unit)
else
  if per<10 then
    return "|cffff0000%s|r",Percent(HP(unit),MaxHP(unit))
  else
    if per<25 then
      return "|cffff5511%s|r",Percent(HP(unit),MaxHP(unit))
    else
      if per<50 then
        return "|cffffcc33%s|r",Percent(HP(unit),MaxHP(unit))
      else
        return "|cff009900%s|r",Percent(HP(unit),MaxHP(unit))
      end
    end
  end
end

-- =======================================================================

/run _CHATHIDE=not _CHATHIDE
for i=1,NUM_CHAT_WINDOWS do
  for _,v in pairs{"","Tab"}do local
    f=_G["ChatFrame"..i..v]
    if _CHATHIDE then
      f.v=f:IsVisible()
    end
      f.ORShow=f.ORShow or f.Show
      f.Show=_CHATHIDE and f.Hide or f.ORShow
      if f.v then
        f:Show()
      end
   end
 end

-- =======================================================================

PriestBarFrame:Hide()
PriestBarFrame:HookScript("OnShow",function(self) self:Hide() end)

MageArcaneChargesFrame:Hide()
MageArcaneChargesFrame:HookScript("OnShow",function(self) self:Hide() end)

MonkHarmonyBarFrame:Hide()
MonkHarmonyBarFrame:HookScript("OnShow",function(self) self:Hide() end)

ComboPointPlayerFrame:Hide()
ComboPointPlayerFrame:HookScript("OnShow",function(self) self:Hide() end)

RuneFrame:Hide()
ComboPointPlayerFrame:HookScript("OnShow",function(self) self:Hide() end)

PaladinPowerBarFrame:Hide()
PaladinPowerBarFrame:HookScript("OnShow",function(self) self:Hide() end)

WarlockPowerFrame:Hide()
WarlockPowerFrame:HookScript("OnShow",function(self) self:Hide() end)

-- =======================================================================

/run _CHATHIDE=not _CHATHIDE for i=1,NUM_CHAT_WINDOWS do for _,v in pairs{"","Tab"}do local f=_G["ChatFrame"..i..v]if _CHATHIDE then f.v=f:IsVisible()end f.ORShow=f.ORShow or f.Show f.Show=_CHATHIDE and f.Hide or f.ORShow if f.v then f:Show()end end end

-- =======================================================================



-- ===========================================================================
function showFrames()
  Minimap:GetParent():SetAlpha(1)
  PlayerFrame:Show()
    ObjectiveTracker_Expand()
  ObjectiveTrackerFrame:Show()
  ShowPartyFrame()
  MainMenuBar:Show()
  MultiBarLeft:Show()
  MultiBarRight:Show()
end

function hideFrames()
  Minimap:GetParent():SetAlpha(0)
  PlayerFrame:Hide()
  ObjectiveTracker_Collapse();
  ObjectiveTrackerFrame:Hide();
  MainMenuBar:Hide()
  MultiBarLeft:Hide()
  MultiBarRight:Hide()
  HidePartyFrame()
end

=======================================================================
/console reloadui
UIParent: SetAlpha (1,0);
print(tostring(select(4, GetBuildInfo())));
message('Hello World!!!!!!! '.. tostring(select(4, GetBuildInfo())));
print('0DejotaUI - WoW versão: '.. tostring(select(4, GetBuildInfo())));

===========================================================================


function toggleChatFrame()
  _CHATHIDE=not _CHATHIDE for i=1,NUM_CHAT_WINDOWS do for _,v in pairs{"","Tab"} do local f=_G["ChatFrame"..i..v] if _CHATHIDE then f.v=f:IsVisible() end f.ORShow=f.ORShow or f.Show f.Show=_CHATHIDE and f.Hide or f.ORShow if f.v then f:Show() end end end

  if ChatFrame1:IsShown() then
    QuickJoinToastButton:Show()
    ChatFrameMenuButton:Show()
    FriendsMicroButton:Show()
    ChatFrame1ButtonFrame:Show()
  else
    QuickJoinToastButton:Hide()
    ChatFrameMenuButton:Hide()
    FriendsMicroButton:Hide()
    ChatFrame1ButtonFrame:Hide()
  end
end
=======================================================================
ObjectiveTrackerFrame:SetAlpha(0)
ObjectiveTrackerFrame:SetScript("OnEnter", function() ObjectiveTrackerFrame:SetAlpha(1) end)
ObjectiveTrackerFrame:SetScript("OnLeave", function() ObjectiveTrackerFrame:SetAlpha(0) end)
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
-- =======================================================================
