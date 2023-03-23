import React, { Fragment, useState, useEffect, createContext } from "react"
import { View, Text, Dimensions, Animated, TouchableHighlight } from "react-native"
import Tailwind from "../../libs/tailwind/Tailwind.lib"
import { connect } from "react-redux"
import GestureRecognizer from "react-native-swipe-detect"
import { XIcon } from "react-native-heroicons/solid"
import NotificationTagItem from "../molecules/NotificationTagItem.molecule"
import SearchImg from "../../assets/ilustrations/search.svg"
import ListNotification from "./ListNotification.organism"

const TagContext = createContext()
const { Provider } = TagContext

const NotificationSidebar = ({ notificationSidebarStatus, changeNotificationSidebarStatus }) => {
    const [height, setHeight] = useState(0)
    const [width, setWidth] = useState(0)
    const [tag, setTag] = useState("Informasi")
    const translate = new Animated.Value(width)
    const notifications = [
        {
            title: "Perlu Bantuan Menggunakan Wemart?",
            description: "Saya Hani dari tim Wemart siap membantu",
            date: "17 Jul 2022, 17:07"
        },
        {
            title: "Perlu Bantuan Menggunakan Wemart?",
            description: "Saya Hani dari tim Wemart siap membantu",
            date: "17 Jul 2022, 17:07"
        }
    ]

    useEffect(() => {
        setHeight(() => Dimensions.get("screen").height)
        setWidth(() => Dimensions.get("screen").width)

        Dimensions.addEventListener("change", () => {
            setHeight(() => Dimensions.get("screen").height)
            setWidth(() => Dimensions.get("screen").width)
        })
    }, [])

    useEffect(() => {
        if(notificationSidebarStatus) {
            openDrawer()
        }
    }, [notificationSidebarStatus])

    const openDrawer = () =>{
        setTimeout(() => {
            Animated.timing(translate, {
                toValue: width - 385,
                useNativeDriver: false,
                duration: 300,
            }).start()
        }, 200);
    }

    const hideDrawer = () => {
        Animated.timing(translate, {
            toValue: width,
            useNativeDriver: false,
            duration: 300
        }).start()

        setTimeout(() => {
            changeNotificationSidebarStatus(false)
        }, 500);
    }

    return (
        <Fragment>
            <GestureRecognizer
                onSwipeRight={ () => hideDrawer() }
            >
                <View style={ [Tailwind`w-full bg-accent--black--60 absolute z-50 flex ${ notificationSidebarStatus ? "flex" : "hidden" }`, { height }] }>
                    <Animated.View style={ [Tailwind`w-96 bg-white py-10`, { height, transform: [{ translateX: translate }] }] }>
                        <View style={ Tailwind`w-full flex flex-row items-center px-6` }>
                            <TouchableHighlight underlayColor={ "#10101010" } style={ Tailwind`rounded-full` } onPress={ () => hideDrawer() }>
                                <XIcon scale={ 22 } style={ Tailwind`text-accent--black opacity-50` }/>
                            </TouchableHighlight>
                            <Text style={ Tailwind`font-rubik-semibold text-accent--black ml-4 text-base` }>
                                Notifikasi
                            </Text>
                        </View>
                        <Provider value={ { tag, setTag } }>
                            <View style={ Tailwind`w-full flex flex-row items-center mt-10 px-6` }>
                                <NotificationTagItem title={ "Informasi" } context={ TagContext }/>
                                <View style={ Tailwind`mr-3` }/>
                                <NotificationTagItem title={ "Promo" } context={ TagContext }/>
                            </View>
                        </Provider>
                        {
                            tag === "Informasi" ?
                                <ListNotification data={ notifications }/> :
                                <View style={ Tailwind`flex flex-col items-center justify-center flex-grow w-full -mt-10` }>
                                    <View style={ Tailwind`flex flex-col items-center` }>
                                        <SearchImg width={ 300 }/>
                                        <Text style={ [Tailwind`font-rubik-semibold text-accent--black ml-4 text-base mt-5`] }>
                                            Belum Ada Notifikasi
                                        </Text>
                                    </View>
                                </View>
                        }
                    </Animated.View>
                </View>
            </GestureRecognizer>
        </Fragment>
    )
}

const mapStateToProps = (state) => {
    return {
        notificationSidebarStatus : state.notificationSidebarStatus
    }
}

const mapDispatchToProps = (dispatch) => {
    return {
        changeNotificationSidebarStatus : (value) => dispatch({type: 'CHANGE_NOTIFICATIONSIDEBARSTATUS', newValue: value})
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(NotificationSidebar)